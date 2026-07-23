{{-- Application Progress Card --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="card shadow border-0 mb-3" id="progressCard">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-0 fw-bold">
                <i class="fas fa-chart-line me-2"></i> Application Progress
            </h6>
            <small class="opacity-75">Complete all mandatory sections</small>
        </div>

        <div class="text-end">
            <span id="progressPercentage" class="badge bg-light text-primary fs-6">0%</span>
            <div class="small mt-1">
                <span id="completedCount">0</span> / 7 Completed
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="progress progress-lg mb-3">
            <div class="progress-bar progress-bar-striped progress-bar-animated"
                 id="mainProgressBar"
                 role="progressbar"
                 style="width:0%">0%</div>
        </div>

        <div class="row g-2">

            @php
            $items=[
                ['general','General','fa-user'],
                ['teaching','Teaching','fa-chalkboard-teacher'],
                ['publication','Publications','fa-book-open'],
                ['project','Projects','fa-diagram-project'],
                ['patent','Patents','fa-lightbulb'],
                ['phd','PhD Students','fa-user-graduate'],
                ['other','Other','fa-award']
            ];
            @endphp

            @foreach($items as $i)
            <div class="col-lg col-md-3 col-sm-4 col-6">
                <div class="progress-box incomplete" id="box-{{ $i[0] }}">
                    <div class="circle">
                        <i class="fas {{ $i[2] }}"></i>
                    </div>

                    <div class="title">{{ $i[1] }}</div>

                    <div class="status">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

<style>
#progressCard{border-radius:14px}
#progressCard .card-header{padding:12px 18px}
.progress-lg{height:16px;border-radius:30px}
#mainProgressBar{
background:linear-gradient(90deg,#198754,#20c997,#0dcaf0);
font-size:11px;font-weight:700;transition:.5s;
}
.progress-box{
background:#fff;
border:2px solid #ececec;
border-radius:12px;
padding:10px;
text-align:center;
transition:.3s;
box-shadow:0 3px 10px rgba(0,0,0,.08);
cursor:pointer;
}
.progress-box:hover{
transform:translateY(-4px);
box-shadow:0 10px 24px rgba(0,0,0,.15);
}
.circle{
width:52px;height:52px;
border-radius:50%;
margin:auto;
display:flex;
align-items:center;
justify-content:center;
background:#f5f5f5;
font-size:20px;
}
.title{
margin-top:8px;
font-size:13px;
font-weight:600;
}
.status{
font-size:18px;
margin-top:4px;
}
.complete{
background:#f0fff4;
border-color:#198754;
}
.complete .circle{
background:#198754;
color:#fff;
}
.complete .status{color:#198754}
.incomplete{
background:#fffdf3;
border-color:#ffc107;
}
.incomplete .circle{
background:#fff3cd;
color:#ff9800;
}
.incomplete .status{color:#ff9800}
@media(max-width:768px){
.circle{width:42px;height:42px;font-size:16px}
.title{font-size:12px}
}
</style>

<script>
$(function(){
    updateProgress();
    $(document).on("keyup change","input,select,textarea",updateProgress);
});

function updateProgress(){

    let completed=0,total=7;

    let general=validateGeneral();
    toggleBox("#box-general",general);
    if(general) completed++;

    let teaching=$("#teachingSummaryContainer .dynamic-item").length>0;
    toggleBox("#box-teaching",teaching);
    if(teaching) completed++;

    let publication=$("#publications6AContainer .dynamic-item").length>0 ||
                    $("#publications6BContainer .dynamic-item").length>0;
    toggleBox("#box-publication",publication);
    if(publication) completed++;

    let project=$("#projectContainer .dynamic-item").length>0;
    toggleBox("#box-project",project);
    if(project) completed++;

    let patent=$("#patentContainer .dynamic-item").length>0;
    toggleBox("#box-patent",patent);
    if(patent) completed++;

    let phd=$("#phdContainer .dynamic-item").length>0;
    toggleBox("#box-phd",phd);
    if(phd) completed++;

    let other=validateOther();
    toggleBox("#box-other",other);
    if(other) completed++;

    let percentage=Math.round((completed/total)*100);

    $("#mainProgressBar").css("width",percentage+"%").text(percentage+"%");
    $("#progressPercentage").text(percentage+"%");
    $("#completedCount").text(completed);
}

function validateGeneral(){
    let fields=["fid","name","department","doj","dojcd","post"];
    for(let i=0;i<fields.length;i++){
        let v=$('[name="'+fields[i]+'"]').val();
        if(!v || $.trim(v)=="") return false;
    }
    return true;
}

function validateOther(){
    let fields=["awards","technology","infrastructure","admin_activities","outreach","national_responsibilities","anyother"];
    for(let i=0;i<fields.length;i++){
        let v=$('[name="'+fields[i]+'"]').val();
        if(v && $.trim(v)!=="") return true;
    }
    return false;
}

function toggleBox(box,status){
    let icon=$(box).find(".status i");
    if(status){
        $(box).removeClass("incomplete").addClass("complete");
        icon.removeClass("fa-times").addClass("fa-check");
    }else{
        $(box).removeClass("complete").addClass("incomplete");
        icon.removeClass("fa-check").addClass("fa-times");
    }
}
</script>
