<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\Auth;
use App\Mail\ApplicationSubmittedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class HRMController extends Controller
{
   

     function __construct()
    {
         
         $this->middleware('permission:claim-create', ['only' => ['index','destroy','show','indexdean','create', 'edit']]);
         
$this->middleware(function ($request, $next) {
    if (in_array($request->route()->getActionMethod(), [])) {
        abort(403, 'create or edit window is closed.');
    }
    return $next($request);
});

    }
    

    public function index()
    {

        $ffiidd = Auth::user()->eid;
        $applications = DB::table('faculty_applications_hr')->where('fid', $ffiidd)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('HR.index', compact('applications'));
    }

    public function indexdean()
    {

        $ffiidd = Auth::user()->id;

       if (in_array($ffiidd, [46, 447 , 769])) {

            
        $applications = DB::table('faculty_applications_hr')->orderBy('created_at', 'desc')
            ->get();
              $applicationsdraft = DB::table('faculty_applications_hr')->where('form_status','draft')->count();
              $applicationssubmitted = DB::table('faculty_applications_hr')->where('form_status','submitted')->count();

            }

            else {

                abort(404, 'Application not found');
            }

        return view('HR.indexdean', compact('applications','applicationsdraft','applicationssubmitted'));
    }
  

    public function create()
    {
        return view('hr.create'); // Fixed: lowercase 'hr'
    }

public function edit($id)
{
    $fiid = Auth::user()->eid;
    $application = DB::table('faculty_applications_hr')->where('id', $id)->where('form_status', 'draft')->first();
    $application1 = DB::table('faculty_applications_hr')->where('id', $id)->where('fid', $fiid)->where('form_status', 'draft')->first();
    
    if (!$application) {
        abort(404, 'Application not found');
    }

      if (!$application1) {
        abort(404, 'Application not found');
    }

    // Load all related data
    $teachingSummaries = DB::table('teaching_summaries_hr')
        ->where('faculty_application_id', $id)
        ->get();

    $publications = DB::table('publications_hr')
        ->where('faculty_application_id', $id)
        ->get();

    $phdStudents = DB::table('phd_students_hr')
        ->where('faculty_application_id', $id)
        ->get();

    $projects = DB::table('projects_hr')
        ->where('faculty_application_id', $id)
        ->get();

    $patents = DB::table('patents_hr')
        ->where('faculty_application_id', $id)
        ->get();

    return view('hr.edit', compact(
        'application',
        'teachingSummaries',
        'publications',
        'phdStudents',
        'projects',
        'patents'
    ));
}

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'fid' => 'required|string|max:4',
                'name' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'doj' => 'required|date',
                'dojcd' => 'required|date',
                'post' => 'required|in:Associate Professor,Professor',
                'slink' => 'required|string|max:2000',
                'form_status' => 'required|in:draft,submitted',
                'declaration' => 'accepted',
                'cv_upload' => 'required|file|mimes:pdf|max:2048', // 2MB max
            ],[
                    'fid.required' => 'Faculty ID is required.',
    'fid.unique' => 'Application for this Faculty ID already submitted.',
    'fid.max' => 'Faculty ID should not exceed 4 characters.',

    'name.required' => 'Please enter the faculty name.',
    'name.max' => 'Name cannot exceed 255 characters.',

    'department.required' => 'Please select or enter the department name.',
    'department.max' => 'Department name cannot exceed 255 characters.',

    'doj.required' => 'Date of Joining (DOJ) is required.',
    'doj.date' => 'Please enter a valid DOJ date.',

    'dojcd.required' => 'Date in Current Designation is required.',
    'dojcd.date' => 'Please enter a valid Date in Current Designation date.',

    'post.required' => 'Please select a post.',
    'post.in' => 'The post must be either Associate Professor or Professor.',



    'cv_upload.required' => 'Please upload your CV in PDF format.',
    'cv_upload.mimes' => 'Only PDF files are allowed for CV upload.',
    'cv_upload.max' => 'The CV file must not be larger than 2MB.',
            ]
        );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    // Handle the CV file upload
    if ($request->hasFile('cv_upload')) {
        // Generate a unique file name
        $cvFile = $request->file('cv_upload');
        $fileName = 'CV_'.time().'_'.$request->fid.'.'.$cvFile->getClientOriginalExtension();
        
        $cvFile->move(public_path('uploads/hr'), $fileName);

    $cvPath = 'uploads/hr/' . $fileName; // store this path in DB
        
        // Now, $cvPath will be 'hr/filename.pdf'
    }

    // Save the form data along with the cv_path to the database
    $data = $request->except('_token', 'cv_upload');
    $data['cv_path'] = $cvPath; // Make sure your model has this field

            // Create main faculty application
            $facultyApplicationId = DB::table('faculty_applications_hr')->insertGetId([
                'fid' => $request->fid,
                'name' => $request->name,
                'department' => $request->department,
                'doj' => $request->doj,
                'dojcd' => $request->dojcd,
                'post' => $request->post,
                'slink' => $request->slink,
                'awards' => $request->awards,
                'technology' => $request->technology,
                'infrastructure' => $request->infrastructure,
                'admin_activities' => $request->admin_activities,
                'outreach' => $request->outreach,
                'national_responsibilities' => $request->national_responsibilities,
                'anyother' => $request->anyother,
                'form_status' => $request->form_status,
                  'cv_filename' => $fileName, // Store filename in database
            'cv_path' => $cvPath, // Store full path in database
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert Teaching Summaries
            $this->insertTeachingSummaries($request, $facultyApplicationId);

            // Process Excel uploads for publications
            $this->processExcelUploads($request, $facultyApplicationId);

            // Insert PhD Students
            $this->insertPhdStudents($request, $facultyApplicationId);

            // Insert Projects
            $this->insertProjects($request, $facultyApplicationId);

            // Insert Patents
            $this->insertPatents($request, $facultyApplicationId);

            DB::commit();

            $message = $request->form_status === 'draft' 
                ? 'Application saved as draft successfully!' 
                : 'Faculty application submitted successfully!';


$application = DB::table('faculty_applications_hr')->where('id', $facultyApplicationId)->where('form_status', 'submitted')->first();

if ($application) {  
    $userEmail = Auth::user()->email;

Mail::mailer('secondary')->to($userEmail)->send(new ApplicationSubmittedMail($application));

}
            return redirect()->route('HRM.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

   public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {
        $validator = Validator::make($request->all(), [
            'fid' => 'required|string|max:4',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'doj' => 'required|date',
            'dojcd' => 'required|date',
            'post' => 'required|in:Associate Professor,Professor',
            'slink' => 'required|string|max:2000',
            'form_status' => 'required|in:draft,submitted',
            'cv_upload' => 'nullable|file|mimes:pdf|max:2048',
            'declaration' => 'accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get current application data
        $currentApplication = DB::table('faculty_applications_hr')->where('id', $id)->first();
        
        if (!$currentApplication) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        // Prepare update data
        $updateData = [
            'fid' => $request->fid,
            'name' => $request->name,
            'department' => $request->department,
            'doj' => $request->doj,
            'dojcd' => $request->dojcd,
            'post' => $request->post,
            'awards' => $request->awards,
            'slink' => $request->slink,
            'technology' => $request->technology,
            'infrastructure' => $request->infrastructure,
            'admin_activities' => $request->admin_activities,
            'outreach' => $request->outreach,
            'national_responsibilities' => $request->national_responsibilities,
            'anyother' => $request->anyother,
            'form_status' => $request->form_status,
            'updated_at' => now(),
        ];

        // Handle CV upload/removal
        if ($request->has('remove_current_cv') && $request->remove_current_cv == '1') {
            // Remove current CV file
            if ($currentApplication->cv_path && file_exists(public_path($currentApplication->cv_path))) {
                unlink(public_path($currentApplication->cv_path));
            }
            $updateData['cv_filename'] = null;
            $updateData['cv_path'] = null;
        }

        // Handle new CV upload
        if ($request->hasFile('cv_upload')) {
            // Remove old CV file if exists
            if ($currentApplication->cv_path && file_exists(public_path($currentApplication->cv_path))) {
                unlink(public_path($currentApplication->cv_path));
            }

            // Upload new CV
            $cvFile = $request->file('cv_upload');
            $fileName = 'CV_'.time().'_'.$request->fid.'.'.$cvFile->getClientOriginalExtension();
            $cvFile->move(public_path('uploads/hr'), $fileName);

            $cvPath = 'uploads/hr/' . $fileName;
            
            $updateData['cv_filename'] = $fileName;
            $updateData['cv_path'] = $cvPath;
        }

        // Update main faculty application
        $updated = DB::table('faculty_applications_hr')->where('id', $id)->update($updateData);

        if (!$updated) {
            throw new \Exception('Failed to update application.');
        }

        // Delete existing related data
        DB::table('teaching_summaries_hr')->where('faculty_application_id', $id)->delete();
        if ($request->has('replace_publications') && $request->replace_publications == '1') {
    DB::table('publications_hr')->where('faculty_application_id', $id)->delete();
}
        DB::table('phd_students_hr')->where('faculty_application_id', $id)->delete();
        DB::table('projects_hr')->where('faculty_application_id', $id)->delete();
        DB::table('patents_hr')->where('faculty_application_id', $id)->delete();

        // Re-insert related data
        $this->insertTeachingSummaries($request, $id);
        $this->processExcelUploads($request, $id);
        $this->insertPhdStudents($request, $id);
        $this->insertProjects($request, $id);
        $this->insertPatents($request, $id);

        DB::commit();

        // Send email if submitted
        if ($request->form_status === 'submitted') {
            $application = DB::table('faculty_applications_hr')->where('id', $id)->first();
            if ($application) {  
                $userEmail = Auth::user()->email;
                Mail::mailer('secondary')->to($userEmail)->send(new ApplicationSubmittedMail($application));
            }
        }

        $message = $request->form_status === 'draft' 
            ? 'Application updated as draft successfully!' 
            : 'Faculty application updated and submitted successfully!';

        return redirect()->route('HRM.index')->with('success', $message);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Application update error: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Error updating application: ' . $e->getMessage())
            ->withInput();
    }
}

    private function insertTeachingSummaries($request, $facultyApplicationId)
    {
        if ($request->has('teaching')) {
            foreach ($request->teaching as $teaching) {
                if (!empty($teaching['course']) && !empty($teaching['title'])) {
                    DB::table('teaching_summaries_hr')->insert([
                        'faculty_application_id' => $facultyApplicationId,
                        'course_number' => $teaching['course'] ?? null,
                        'course_title' => $teaching['title'] ?? null,
                        'year_semester' => $teaching['semester'] ?? null,
                        'credits' => $teaching['credits'] ?? null,
                        'students' => $teaching['students'] ?? null,
                        'feedback' => $teaching['feedback'] ?? null,
                        'ap' => $teaching['ap'] ?? null,
                        'instructors' => $teaching['instructors'] ?? null,
                        'response' => $teaching['response'] ?? null,
                        'SCORE' => $teaching['SCORE'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function processExcelUploads($request, $facultyApplicationId)
    {
        $post = $request->post;
        $prefix = $post === 'Associate Professor' ? 'ap_asp' : 'asp_p';

        // Process all possible Excel upload fields
        $sections = $post === 'Associate Professor' ? ['A', 'B'] : ['A', 'B', 'C', 'D'];
        $types = ['journal', 'conference'];

        foreach ($sections as $section) {
            foreach ($types as $type) {
                $fieldName = "excel_{$prefix}_{$section}_{$type}";
                
                if ($request->has($fieldName) && !empty($request->$fieldName)) {
                    $publications = json_decode($request->$fieldName, true);
                    
                    if (is_array($publications)) {
                        foreach ($publications as $pub) {
                            if (!empty($pub['title'])) {
                                DB::table('publications_hr')->insert([
                                    'faculty_application_id' => $facultyApplicationId,
                                    'publication_type' => $type,
                                    'section_type' => "{$prefix}_{$section}",
                                    'title' => $pub['title'],
                                      'journal_name' => $pub['name'] ?? null,
                                      'authors' => $pub['authors'] ?? null,
                                       'year' => $pub['year'] ?? null,
                                               'volume' => $pub['volume'] ?? null,
                                    'impact_factor' => $pub['standard'] ?? null,
                                    'quartile' => $pub['quartile'] ?? null,
                                    
                
                                    'source' => 'excel_upload',
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

    private function insertPhdStudents($request, $facultyApplicationId)
    {
        if ($request->has('phd_graduated')) {
            foreach ($request->phd_graduated as $phd) {
                if (!empty($phd['name'])) {
                    DB::table('phd_students_hr')->insert([
                        'faculty_application_id' => $facultyApplicationId,
                        'student_type' => strtolower($phd['statusphd'] ?? 'ongoing'),
                        'student_name' => $phd['name'],
                        'year' => $phd['year'] ?? null,
                        'status_position' => $phd['position'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function insertProjects($request, $facultyApplicationId)
    {
        if ($request->has('projects')) {
            foreach ($request->projects as $project) {
                if (!empty($project['title'])) {
                    DB::table('projects_hr')->insert([
                        'faculty_application_id' => $facultyApplicationId,
                        'pi_type' => $project['pi'] ?? 'PI',
                        'project_title' => $project['title'],
                        'sponsoring_agency' => $project['agency'] ?? null,
                        'period' => $project['period'] ?? null,
                        'cost' => $project['cost'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function insertPatents($request, $facultyApplicationId)
    {
        if ($request->has('patents')) {
            foreach ($request->patents as $patent) {
                if (!empty($patent['no'])) {
                    DB::table('patents_hr')->insert([
                        'faculty_application_id' => $facultyApplicationId,
                        'patent_number' => $patent['no'],
                        'patent_name' => $patent['name'] ?? null,
                        'inventors' => $patent['inventor'] ?? null,
                        'status' => $patent['status'] ?? 'Filed',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    public function show($id)
    {
       $application = DB::table('faculty_applications_hr')->where('id', $id)->first();

$loggedInEid = auth()->user()->eid ?? null;
$userId = auth()->user()->id ?? null;

// Allow users with ID 46 or 50 to bypass the check
if (!in_array($userId, [46,236,447])) {
    if (!$application || $application->fid != $loggedInEid) {
        abort(403, 'Unauthorized access to application');
    }
}


        $teachingSummaries = DB::table('teaching_summaries_hr')
            ->where('faculty_application_id', $id)
            ->get();

        $publications = DB::table('publications_hr')
            ->where('faculty_application_id', $id)
            ->get();

        $phdStudents = DB::table('phd_students_hr')
            ->where('faculty_application_id', $id)
            ->get();

        $projects = DB::table('projects_hr')
            ->where('faculty_application_id', $id)
            ->get();

        $patents = DB::table('patents_hr')
            ->where('faculty_application_id', $id)
            ->get();

        $categorizedPublications = $this->categorizePublications($publications, $application->post);

        $data = compact(
            'application',
            'teachingSummaries',
            'categorizedPublications',
            'phdStudents',
            'projects',
            'patents'
        );

        $pdf = PDF::loadView('hr.show', $data);
        return $pdf->stream($application->fid . '_application.pdf');
    }


        public function report($id)
    {
       
$application = DB::table('faculty_applications_hr')->where('id', $id)->first();
        $publications = DB::table('publications_hr')
            ->where('faculty_application_id', $id)
            ->get();
        $categorizedPublications = $this->categorizePublications($publications, $application->post);


         return view('HR.reports', compact('application','publications','categorizedPublications'));
    }

       public function teachings($id)
    {
       
$application = DB::table('faculty_applications_hr')->where('id', $id)->first();
        $teachingSummaries = DB::table('teaching_summaries_hr')
            ->where('faculty_application_id', $id)
            ->get();
  
         return view('HR.partials.teachings', compact('application','teachingSummaries'));
    }

           public function patents($id)
    {
       
$application = DB::table('faculty_applications_hr')->where('id', $id)->first();
         $patents = DB::table('patents_hr')
            ->where('faculty_application_id', $id)
            ->get();
  
         return view('HR.partials.patents', compact('application','patents'));
    }

           public function phdstudents($id)
    {
       
$application = DB::table('faculty_applications_hr')->where('id', $id)->first();
        $phdStudents = DB::table('phd_students_hr')
            ->where('faculty_application_id', $id)
            ->get();
         return view('HR.partials.phdstudents', compact('application','phdStudents'));
    }

           public function projects($id)
    {
       
$application = DB::table('faculty_applications_hr')->where('id', $id)->first();
     $projects = DB::table('projects_hr')
            ->where('faculty_application_id', $id)
            ->get();
  
         return view('HR.partials.projects', compact('application','projects'));
    }




    private function categorizePublications($publications, $post)
    {
        $categorized = [];

        if ($post === 'Associate Professor') {
            $categorized['section_a_journal'] = $publications->where('section_type', 'ap_asp_a')->where('publication_type', 'journal')->values();
            $categorized['section_a_conference'] = $publications->where('section_type', 'ap_asp_a')->where('publication_type', 'conference')->values();
            $categorized['section_b_journal'] = $publications->where('section_type', 'ap_asp_b')->where('publication_type', 'journal')->values();
            $categorized['section_b_conference'] = $publications->where('section_type', 'ap_asp_b')->where('publication_type', 'conference')->values();
        } else {
            $categorized['section_a_journal'] = $publications->where('section_type', 'asp_p_a')->where('publication_type', 'journal')->values();
            $categorized['section_a_conference'] = $publications->where('section_type', 'asp_p_a')->where('publication_type', 'conference')->values();
            $categorized['section_b_journal'] = $publications->where('section_type', 'asp_p_b')->where('publication_type', 'journal')->values();
            $categorized['section_b_conference'] = $publications->where('section_type', 'asp_p_b')->where('publication_type', 'conference')->values();
            $categorized['section_c_journal'] = $publications->where('section_type', 'asp_p_c')->where('publication_type', 'journal')->values();
            $categorized['section_c_conference'] = $publications->where('section_type', 'asp_p_c')->where('publication_type', 'conference')->values();
            $categorized['section_d_journal'] = $publications->where('section_type', 'asp_p_d')->where('publication_type', 'journal')->values();
            $categorized['section_d_conference'] = $publications->where('section_type', 'asp_p_d')->where('publication_type', 'conference')->values();
        }

        return $categorized;
    }
    

public function downloadAllApplications()
{

     ini_set('max_execution_time', 0);
    ini_set('memory_limit', '1024M');
    $adminIds = [46, 447, 769];
    $ffiidd = Auth::user()->id;

    if (!in_array($ffiidd, $adminIds)) {
        abort(403, 'Unauthorized');
    }

    // Fetch all applications
    $applications = DB::table('faculty_applications_hr')
        ->orderBy('created_at', 'desc')
        ->get();

    if ($applications->isEmpty()) {
        return back()->with('error', 'No applications found.');
    }

    // Base temporary folder
    $basePath = storage_path('app/public/uploads/hr');
    if (!File::exists($basePath)) {
        File::makeDirectory($basePath, 0777, true);
    }

    // Clean any old data
    File::cleanDirectory($basePath);

    // Loop through each faculty application
    foreach ($applications as $application) {
        // Sanitize name to avoid spaces or special characters in folder name
$facultyName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $application->name);
$facultyFolder = $basePath . '/' . $application->fid . '_' . $facultyName;


        // Create individual faculty folder
        if (!File::exists($facultyFolder)) {
            File::makeDirectory($facultyFolder, 0777, true);
        }

        // Fetch related data
        $teachingSummaries = DB::table('teaching_summaries_hr')->where('faculty_application_id', $application->id)->get();
        $publications = DB::table('publications_hr')->where('faculty_application_id', $application->id)->get();
        $phdStudents = DB::table('phd_students_hr')->where('faculty_application_id', $application->id)->get();
        $projects = DB::table('projects_hr')->where('faculty_application_id', $application->id)->get();
        $patents = DB::table('patents_hr')->where('faculty_application_id', $application->id)->get();

        $categorizedPublications = $this->categorizePublications($publications, $application->post);

        $data = compact(
            'application',
            'teachingSummaries',
            'categorizedPublications',
            'phdStudents',
            'projects',
            'patents'
        );

        // Generate PDF
        $pdf = PDF::loadView('hr.show', $data);
        $pdfPath = $facultyFolder . '/' . $application->fid . '_application.pdf';
        $pdf->save($pdfPath);

        // Include CV if available
      if (!empty($application->cv_path)) {
    $cvFile = public_path($application->cv_path); // points to public/uploads/hr/...
    if (File::exists($cvFile)) {
        File::copy($cvFile, $facultyFolder . '/' . basename($cvFile));
    }
}
    }

    // Create ZIP
    $zipFile = storage_path('app/public/all_faculty_applications.zip');
    $zip = new ZipArchive;
    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basePath));

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($basePath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

    // Cleanup folder after zipping
    File::deleteDirectory($basePath);

    // Download ZIP
    return response()->download($zipFile)->deleteFileAfterSend(true);
}


    public function destroy($id)
    {
        // DB::beginTransaction();
        
        // try {
        //     // Delete related records first
        //     DB::table('teaching_summaries_hr')->where('faculty_application_id', $id)->delete();
        //     DB::table('publications_hr')->where('faculty_application_id', $id)->delete();
        //     DB::table('phd_students_hr')->where('faculty_application_id', $id)->delete();
        //     DB::table('projects_hr')->where('faculty_application_id', $id)->delete();
        //     DB::table('patents_hr')->where('faculty_application_id', $id)->delete();
            
        //     // Delete main application
        //     DB::table('faculty_applications_hr')->where('id', $id)->delete();
            
        //     DB::commit();
            
        //     return redirect()->route('HRM.index')->with('success', 'Application deleted successfully!');
            
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('HRM.index')->with('error', 'Error deleting application: ' . $e->getMessage());
        // }
    }
}