@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Google Sheets</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Links</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Google Sheets</h4>

                      <div class="pull-right">
           
            </div>


										</div>
          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
              
                  <th class="wd-15p">Name</th>
            
                  <th class="wd-15p">Link</th>
                  

                </tr>
              </thead>
              <tbody>
              <tr><td><b>Department Contingency Grant </b><td></td></tr>
<tr><td>Central Workshop</td><td><a href="https://docs.google.com/spreadsheets/d/1CjvKY_X2nbBypl8ifG3Z_5EspP3v8Q0Vy95jK5v9Apo/edit#gid=468265935">Central Workshop</a></td></tr>
<tr><td>Computer Centre</td><td><a href="https://docs.google.com/spreadsheets/d/1n3ianrjYkie51jEA8ceDLi4LltCzQ1fT_2CH4oXsPsQ/edit#gid=259174001">Computer Centre</a></td></tr>
<tr><td>Centre for Continuing Education</td><td><a href="https://docs.google.com/spreadsheets/d/1KNsmCq3AUkdO6K-C_268v0yq5vBhmLzcuPZ4lv5KRR4/edit?usp=sharing">Centre for Continuing Education</a></td></tr>
<tr><td>Centre for Rural Development</td><td><a href="https://docs.google.com/spreadsheets/d/1lkehMX577Ii79fSIJVz0ZIUYedJpOd4H-uvJqA3Rm9g/edit#gid=0">Centre for Rural Development</a></td></tr>
<tr><td>Centre for ID Programs</td><td><a href="https://docs.google.com/spreadsheets/d/1Cn9VPqTinffEe-8vO2vPDohv6q7apOvNN2ptBTYtwLc/edit#gid=1458092654">Centre for ID Programs</a></td></tr>
<tr><td>Dept. of Artificial Intelligence</td><td><a href="https://docs.google.com/spreadsheets/d/1W9271diVsKwRD_piYfHJHMHOE41vInLn-KdCossRQbE/edit#gid=1520018846">Dept. of Artificial Intelligence</a></td></tr>
<tr><td>Dept. of Biomedical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/13PBU3MO91dUbG9a1tUSH4q_hSeHXNDgstJ3a3UlpIXs/edit#gid=1340626658">Dept. of Biomedical Engineering</a></td></tr>
<tr><td>Dept. of Biotechnology</td><td><a href="https://docs.google.com/spreadsheets/d/1wqE2rh6YuaWvJx5TURmxDvCP2vEiFZTG5jnMMew-48s/edit#gid=131407921">Dept. of Biotechnology</a></td></tr>
<tr><td>Dept. of Chemical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1g8k085sdCEGpZAfwMpKcugF5ccNoF5kjirBIHh9-UUM/edit#gid=257347284">Dept. of Chemical Engineering</a></td></tr>
<tr><td>Dept. of Chemistry</td><td><a href="https://docs.google.com/spreadsheets/d/1ld4jHE7puSDZruntODGAfztwqRRk6KvUxazBerL8c-k/edit#gid=2026271325">Dept. of Chemistry</a></td></tr>
<tr><td>Dept. of Climate Change</td><td><a href="https://docs.google.com/spreadsheets/d/16klEvInlA1f2TuvwXyVabd4cZMQSJMavJO2iqFBaKoU/edit#gid=698153425">Dept. of Climate Change</a></td></tr>
<tr><td>Dept. of Civil Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1Rk21rj8BXNhQ80-sadsXQtkzSZzao8pwuEmmLcfXzDY/edit#gid=2054989529">Dept. of Civil Engineering</a></td></tr>
<tr><td>Dept. of Computer & Science Engg.</td><td><a href="https://docs.google.com/spreadsheets/d/13alYwnCgHSmX8MUo31Vm3KF6WhwOHb_YnpPdZY5_J3A/edit#gid=729048812">Dept. of Computer & Science Engg.</a></td></tr>
<tr><td>Dept. of Design</td><td><a href="https://docs.google.com/spreadsheets/d/1yLXwIhghe6898cZtZ-VqRUHLvGI87HWstl_ZGXQlBP4/edit#gid=1207263501">Dept. of Design</a></td></tr>
<tr><td>Dept. of Electrical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1XNMjWdc3K26gmbboWWOzvKBlB0RKuAmEQfBXYPg1JTc/edit#gid=1252456766">Dept. of Electrical Engineering</a></td></tr>
<tr><td>Dept. of Engineering Science</td><td><a href="https://docs.google.com/spreadsheets/d/1vc_rFR6qrkRXvL2ll0_XM7X-vKBGac099f7VsMCo9Fg/edit#gid=1626543270">Dept. of Engineering Science</a></td></tr>
<tr><td>Dept. of Entrepreneurship & Management</td><td><a href="https://docs.google.com/spreadsheets/d/1ADXPQTUPu8NK6lckkO9ALesQKsk3s1eiUo1fgC3rS1Y/edit#gid=1317841185">Dept. of Entrepreneurship & Management</a></td></tr>
<tr><td>Dept. of Heritage in Science & Technology</td><td><a href="https://docs.google.com/spreadsheets/d/1yDF5Pf2KOiGfses7Kyhr1vusEdcyvJ41afUE8lrbqRE/edit#gid=0">Dept. of Heritage in Science & Technology</a></td></tr>
<tr><td>Dept. of Liberal Arts</td><td><a href="https://docs.google.com/spreadsheets/d/1XhwYDw5kd8J26F_yzUacu3abc7ukz7Hu-WrQe7q55aQ/edit#gid=1109703111">Dept. of Liberal Arts</a></td></tr>
<tr><td>Dept. of Mathematics</td><td><a href="https://docs.google.com/spreadsheets/d/1REQ8qjnp2oZ5LziXnIcz9rIKmgVt4P0AAfG8uqL-37g/edit#gid=1975323485">Dept. of Mathematics</a></td></tr>
<tr><td>Dept. of Materials Science & Metallurgical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/17fjREPpTUZ-gFLor9PqbBiM2LoSIxj2wk_YNi9M21KA/edit#gid=1815881461">Dept. of Materials Science & Metallurgical Engineering</a></td></tr>
<tr><td>Dept. of Mechanical & Aerospace Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1D5a9JTTsPT8aqonoRt52Z-xC4plF8WiL9dNHt7F4CNY/edit#gid=1990920501">Dept. of Mechanical & Aerospace Engineering</a></td></tr>
<tr><td>Dept. of Physics</td><td><a href="https://docs.google.com/spreadsheets/d/1JKAvYeO01ktjpW66EYyjuqq3l2Aq6J-206LC80WazSo/edit#gid=521154238">Dept. of Physics</a></td></tr>
<tr><td><b>Department Research Grant IRG</td></b><td></td></tr>
<tr><td>Centre for ID Programs</td><td><a href="https://docs.google.com/spreadsheets/d/1N1txPqPBfbOD5NEyHEFpHKnhrY5rpwzdbJg0myhnZvs/edit#gid=140266397">Centre for ID Programs</a></td></tr>
<tr><td>Dept. of Artificial Intelligence</td><td><a href="https://docs.google.com/spreadsheets/d/1ydJHXTDKCaqtnpPY4JapMggSnyst8tkfMGNRPT_53zk/edit#gid=1803339343">Dept. of Artificial Intelligence</a></td></tr>
<tr><td>Dept. of Biomedical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1PD_TS2O1g_TNVusgtUML6ow-9lxdTHMizT4o88ALUzI/edit#gid=1882834670">Dept. of Biomedical Engineering</a></td></tr>
<tr><td>Dept. of Biotechnology</td><td><a href="https://docs.google.com/spreadsheets/d/1gkfx-DsDSYwjEc8486iw9t_yy0CbYfUnOQT9Q84iyLg/edit#gid=1944355724">Dept. of Biotechnology</a></td></tr>
<tr><td>Dept. of Chemical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1tZDdvRc6zy6vlPu-G4G6-UNr3qKDFKacnLgTfPMDsws/edit#gid=1130951815">Dept. of Chemical Engineering</a></td></tr>
<tr><td>Dept. of Chemistry</td><td><a href="https://docs.google.com/spreadsheets/d/1SaIrtNQcJ0U8TxmOyve7pd4BOH-x31O70cMsAoxNhSg/edit#gid=274831979">Dept. of Chemistry</a></td></tr>
<tr><td>Dept. of Climate Change</td><td><a href="https://docs.google.com/spreadsheets/d/18DKP7EKy5JHufXVRYKLHOk3Rvx9jx1O74Rd_KMEMlzQ/edit#gid=581190399">Dept. of Climate Change</a></td></tr>
<tr><td>Dept. of Civil Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1KpZidwVeJfSrzjI5PD2zJ0H2mDsaFoxqqUEB812GWWU/edit#gid=311135814">Dept. of Civil Engineering</a></td></tr>
<tr><td>Dept. of Computer & Science Engg.</td><td><a href="https://docs.google.com/spreadsheets/d/1M1gFzIjbRxPnxaFrMpQAU07qinB6i3UaF0WMo7wjAyE/edit#gid=1635647350">Dept. of Computer & Science Engg.</a></td></tr>
<tr><td>Dept. of Design</td><td><a href="https://docs.google.com/spreadsheets/d/1ndkky0nDGgdioPPH_IpBRQ6JQbKcn-1WnfRiyb_fX7I/edit#gid=930312368">Dept. of Design</a></td></tr>
<tr><td>Dept. of Electrical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1rp4sNwjWgY8w2a2hT1ATaAvmfKVxWIoNSz8_6ZnRQBQ/edit#gid=1504772255">Dept. of Electrical Engineering</a></td></tr>
<tr><td>Dept. of Engineering Science</td><td><a href="https://docs.google.com/spreadsheets/d/1vc_rFR6qrkRXvL2ll0_XM7X-vKBGac099f7VsMCo9Fg/edit#gid=297937451">Dept. of Engineering Science</a></td></tr>
<tr><td>Dept. of Entrepreneurship & Management</td><td><a href="https://docs.google.com/spreadsheets/d/1I0PWcy0JTFW3hN8MEbyyaRpwSvU_qoltS6qV4jaOdO8/edit#gid=1927625101">Dept. of Entrepreneurship & Management</a></td></tr>
<tr><td>Dept. of Liberal Arts</td><td><a href="https://docs.google.com/spreadsheets/d/18brAi1cxplTjFp3n1rRqP2hxGSLU4Ezw1swJUed3JgI/edit#gid=1971104007">Dept. of Liberal Arts</a></td></tr>
<tr><td>Dept. of Mathematics</td><td><a href="https://docs.google.com/spreadsheets/d/1mPeKxKxzP91snVed-Q9hjKfHvLQGbavq8eQunPkor7c/edit#gid=1643821486">Dept. of Mathematics</a></td></tr>
<tr><td>Dept. of Materials Science & Metallurgical Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/17KV35Vms0kvjfQoJgE5Jg-gQF2DrVrPNomXgpLAeHZI/edit#gid=1090230858">Dept. of Materials Science & Metallurgical Engineering</a></td></tr>
<tr><td>Dept. of Mechanical & Aerospace Engineering</td><td><a href="https://docs.google.com/spreadsheets/d/1Z59OPBlDKwq_VtOFR6VuCePkhhDLvC81UrDawk5oHkc/edit#gid=1213845879">Dept. of Mechanical & Aerospace Engineering</a></td></tr>
<tr><td>Dept. of Physics</td><td><a href="https://docs.google.com/spreadsheets/d/1xOlNYuLDJzAcyuvut_Yb0kr_Z7jP5w-X7qiAQZg-vh0/edit#gid=1037139247">Dept. of Physics</a></td></tr>
<tr><td><b>Faculty Funding </td></b><td></td></tr>
<tr><td>Seed Grant to New Faculty </td><td><a href="https://docs.google.com/spreadsheets/d/1XKN_7scTXcapTFqNcdm6AcAdkeXQ0K-P/edit#gid=892101520">Seed Grant to New Faculty </a></td></tr>
<tr><td>Rural Development Research Grant (RD Project)</td><td><a href="https://docs.google.com/spreadsheets/d/1owS04heD9LlyI7XXnTmPb0p235SzwRpci9fp_KDLETU/edit#gid=0">Rural Development Research Grant (RD Project)</a></td></tr>
<tr><td>Travel grant(Faculty)</td><td><a href="https://docs.google.com/spreadsheets/d/1AK-CiNmOPs3sxM6eG99WswhsiBUWQtCs9Nkx7YFR6qc/edit#gid=82747865">Travel grant(Faculty)</a></td></tr>
<tr><td><b>Student Funding </td></b><td></td></tr>
<tr><td>BUILD Scheme_JAN 2022 & JULY 2022</td><td><a href="https://docs.google.com/spreadsheets/d/1Y5nv5DQ63z57O61UDdO0Bobbvclbm9CFK4ZF2bzxiHM/edit#gid=0">BUILD Scheme_JAN 2022 & JULY 2022</a></td></tr>
<tr><td>Inter Disciplinary Research Grant (ID Project)</td><td><a href="https://docs.google.com/spreadsheets/d/186YYVmy2gVOxZFI7EWYzzWk8yoLZGITvP7HgttqQDDQ/edit#gid=0">Inter Disciplinary Research Grant (ID Project)</a></td></tr>
<tr><td>ID PhD Contingency 2022</td><td><a href="https://docs.google.com/spreadsheets/d/1w62ZAsNSKwZRs3zncUXXVUaN_kxAeYaz/edit#gid=1987490879">ID PhD Contingency 2022</a></td></tr>
<tr><td>First fellowship programe</td><td><a href="https://docs.google.com/spreadsheets/d/19NvBLqFPX1RjWHJvxzbI0cEyNcYc9Tw1oKtFZosWAq0/edit#gid=0">First fellowship programe</a></td></tr>
<tr><td><b>Budget Commitments</td></b><td></td></tr>
<tr><td>Registrar Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1DBiBkHFK00jtzcIzYaUDF_xwiVDHUDRSo3hASzp2SwU/edit#gid=0">Registrar Budget FY 2022-23</a></td></tr>
<tr><td>Dean (Admin) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1rWSUB3RcmKYPnzE2NaBb0LWHSl8LQuDmrSj-BmbVTV0/edit#gid=1823147751">Dean (Admin) Budget FY 2022-23</a></td></tr>
<tr><td>Dean (Acad) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1mQBy2HKWvCk9iRISVr1rSjONbcz7-RV2zFBzB1Inr4Q/edit#gid=1761403572">Dean (Acad) Budget FY 2022-23</a></td></tr>
<tr><td>Dean (PCR) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1wW2MsY0-e9Jv4p-UpVUzM_QrOIr-8l9xTkh_E7vZYQw/edit#gid=0">Dean (PCR) Budget FY 2022-23</a></td></tr>
<tr><td>Dean (AR) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/16_bJKkPwLVmAcoPk504bVewM8iVvfESxJOwGqwTwoPY/edit#gid=0">Dean (AR) Budget FY 2022-23</a></td></tr>
<tr><td>Dean (IR) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1EOMp4ejd91o2h7fBDZmYgfP2wtrbdxuiTmib-G3NCUE/edit#gid=0">Dean (IR) Budget FY 2022-23</a></td></tr>
<tr><td>Dean (Faculty) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1FSvw-tAK5qxBTdOJQywR8K4M0ZdSbjrpgAta3VyMVVg/edit#gid=0">Dean (Faculty) Budget FY 2022-23</a></td></tr>
<tr><td>Dean (Students) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/15MlbGyBLOdCwVTksCF14JSIEKRwtRprWbxsaF36wNbA/edit#gid=0">Dean (Students) Budget FY 2022-23</a></td></tr>
<tr><td>Director Office (Director) Bduegt FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/10W4uABhJZahKRFOY884lQxFPzKYr8au6CIC41KHbpCA/edit#gid=0">Director Office (Director) Bduegt FY 2022-23</a></td></tr>
<tr><td>Associate Dean (Plan) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1veURJgt16yah3nI2zP47bG02LmD8Ht0Ih9i7EZJb7E4/edit#gid=0">Associate Dean (Plan) Budget FY 2022-23</a></td></tr>
<tr><td>Chair (CC) Budget FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1Wsftag-ZNCU0ZmbpwZou-FuOaA2s_6C-vRkA_7Z6Fws/edit#gid=0">Chair (CC) Budget FY 2022-23</a></td></tr>
<tr><td>Director's approval FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1ydNstSb-FfH8YS9mHJPrDwvsHK26k3rbUFShEFTNHkI/edit#gid=322453844">Director's approval FY 2022-23</a></td></tr>
<tr><td><b>Register</td></b><td></td></tr>
<tr><td>Imprest FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1MWcaFBHzxDD05M6mL_-DaCeQQHjzXuoui1SlzvaCb7c/edit#gid=0">Imprest FY 2022-23</a></td></tr>
<tr><td>Travel adv and Temp adv</td><td><a href="https://docs.google.com/spreadsheets/d/1gmra0ilwob3TExuJYOOV9npLUakJvzHy0BBGe7df7BQ/edit#gid=224702566">Travel adv and Temp adv</a></td></tr>
<tr><td><b>working Sheets</td></b><td></td></tr>
<tr><td>btbm,chy,msme,ce budget & HOD Cabin</td><td><a href="https://docs.google.com/spreadsheets/d/1q2KnPfaI0jStJjOTdiEoib-WDDQq15GxrMwVb8cHcys/edit#gid=0">btbm,chy,msme,ce budget & HOD Cabin</a></td></tr>
<tr><td>Chair CC </td><td><a href="https://docs.google.com/spreadsheets/d/1lWT6M7hkCnKNiNonIOwr0uxl5kadkL6M/edit#gid=1213545093">Chair CC </a></td></tr>
<tr><td>Dean Admin Budget</td><td><a href="https://docs.google.com/spreadsheets/d/1p5mI8kPPxe2slx4IlA8tXPT0ExWRamWG/edit#gid=1207031452">Dean Admin Budget</a></td></tr>
<tr><td>Forex payments 7764</td><td><a href="https://docs.google.com/spreadsheets/d/1vPi3mu1RkP2XuMD5UIMaUe-l6HqnJhtY/edit#gid=1567217703">Forex payments 7764</a></td></tr>
<tr><td>library gst rcm</td><td><a href="https://docs.google.com/spreadsheets/d/1gwTGTjcwVC4WvbhjI7x4u-AUd2CPX1Mc/edit#gid=520957354">library gst rcm</a></td></tr>
<tr><td>Request for utilisation of equipment facility</td><td><a href="https://docs.google.com/spreadsheets/d/17fqrlRRByZHpHStHghIXmCK2dZSGUeT6ZqcQavBc-X0/edit#gid=0">Request for utilisation of equipment facility</a></td></tr>
<tr><td><b>old sheets</td></b><td></td></tr>
<tr><td>Chair CC</td><td><a href="https://docs.google.com/spreadsheets/d/1Vqxl3Ysv2yJiNPcnmf5L-RFrzVaduigAAWHDD8o8CXQ/edit#gid=840717610">Chair CC</a></td></tr>
<tr><td>Academic Miscellaneous expenses</td><td><a href="https://docs.google.com/spreadsheets/d/1LbgBgVoe9my8lky7YFAJsWMLgfDyvIsHKhwDqlua6qE/edit#gid=0">Academic Miscellaneous expenses</a></td></tr>
<tr><td>Block Grant Sheet.xlsx</td><td><a href="https://docs.google.com/spreadsheets/d/1G2x2t_5CCR7UdCr-piHlLhrLAjRO3xR6f5VpZd8QaHY/edit#gid=2107556481">Block Grant Sheet.xlsx</a></td></tr>
<tr><td>Build Project Sep 2021 to Dec 2021(Extended till 15.03.2022)</td><td><a href="https://docs.google.com/spreadsheets/d/1OuilECHYbT7CpfHGFF_nf8mP0QlQkzZ2b-dXptx7ACA/edit#gid=0">Build Project Sep 2021 to Dec 2021(Extended till 15.03.2022)</a></td></tr>
<tr><td>BUILD PROJECTS 2021 FROM IRG</td><td><a href="https://docs.google.com/spreadsheets/d/1NYo0bz2Uq6cdkKlzhSCpOyg_ldPKRELXnup5gNBX3rU/edit#gid=0">BUILD PROJECTS 2021 FROM IRG</a></td></tr>
<tr><td>CMD Budget</td><td><a href="https://docs.google.com/spreadsheets/d/1kT9jqkJtigsYm9fPhWLfFJiAxIWFJTJDdyaz67w6q60/edit#gid=327002711">CMD Budget</a></td></tr>
<tr><td>DEAN PCR</td><td><a href="https://docs.google.com/spreadsheets/d/1AOq2z-0bh0EB_bRtdRRIRhhOaXKRtHwahyutQWq88wQ/edit#gid=0">DEAN PCR</a></td></tr>
<tr><td>Departmental Funds from IRG 2020-21</td><td><a href="https://docs.google.com/spreadsheets/d/1r7ggSpudQJ-lVu720aL7NDojlw5Bi6WqjbP1KJDd2vY/edit#gid=0">Departmental Funds from IRG 2020-21</a></td></tr>
<tr><td>Dispenasary Budget</td><td><a href="https://docs.google.com/spreadsheets/d/1nlPI5P2CrTfNI9UyUq_WVpL_otLp_i6NU_XLhWYkEi4/edit#gid=0">Dispenasary Budget</a></td></tr>
<tr><td>Green office</td><td><a href="https://docs.google.com/spreadsheets/d/15X4vlIzRmXiI6yhxLNqMNJj8I_Ms9_euzhG_D4R1O0w/edit#gid=0">Green office</a></td></tr>
<tr><td>GSTR-1 and 3B data FY 21-22</td><td><a href="https://docs.google.com/spreadsheets/d/1fvi9vhD4wtCDiFOt-mowTnj5mfwnqFv6Ns9MBEnpZ6k/edit#gid=1956117548">GSTR-1 and 3B data FY 21-22</a></td></tr>
<tr><td>Housekeeping salaries and Materials</td><td><a href="https://docs.google.com/spreadsheets/d/1aCVFkzeMUSlzqm3c9HP-PvbLFq_GTZfeWUNZoBOOrLc/edit#gid=0">Housekeeping salaries and Materials</a></td></tr>
<tr><td>ID (INTER DESCIPLINARY PROJECTS) 2020-21 OF FACULTY</td><td><a href="https://docs.google.com/spreadsheets/d/120q2DK6Zgal47PEWyep1YFpdJvDgDdXpil2IJzL1Nvs/edit#gid=0">ID (INTER DESCIPLINARY PROJECTS) 2020-21 OF FACULTY</a></td></tr>
<tr><td>IIIT Raichur Seed Grant</td><td><a href="https://docs.google.com/spreadsheets/d/1KZzeupqIrDYJenlI7kXKrTs9VmCveZ3Uft2rSSJTKWo/edit#gid=0">IIIT Raichur Seed Grant</a></td></tr>
<tr><td>IITH - Chart of Accounts</td><td><a href="https://docs.google.com/spreadsheets/d/1_KVwnW_glsURZAdtpJTPGSHOFPhE4MVR/edit#gid=2136665679">IITH - Chart of Accounts</a></td></tr>
<tr><td>MONTHLY LICENSE FEE COLLECTIONS</td><td><a href="https://docs.google.com/spreadsheets/d/1NH7uG2MvIcmyFG_yd64XneZWv41hZciXEQYkAHhOBno/edit#gid=0">MONTHLY LICENSE FEE COLLECTIONS</a></td></tr>
<tr><td>New Seed Grants funding 2020-21</td><td><a href="https://docs.google.com/spreadsheets/d/1IJg58G1bOjsoSTqZeaKxZS3UOtiyt0TLRj0Ay5PhR9Y/edit#gid=1113753815">New Seed Grants funding 2020-21</a></td></tr>
<tr><td>Postage</td><td><a href="https://docs.google.com/spreadsheets/d/1Kj20QF_y4R7cVqJ0ER2F0kS8txRX3GZS21JULV_IY4I/edit#gid=0">Postage</a></td></tr>
<tr><td>Printing and stationary</td><td><a href="https://docs.google.com/spreadsheets/d/10SJO06zlo3CilAVhote-2M9QV-12ahiMdZfSyHcywMg/edit#gid=0">Printing and stationary</a></td></tr>
<tr><td>Professor_Honorarium 15-02-2022</td><td><a href="https://docs.google.com/spreadsheets/d/1_bHatTyQwXdYUm4tXgczDATOJkH-_LCyL8g3xayIyO4/edit#gid=0">Professor_Honorarium 15-02-2022</a></td></tr>
<tr><td>RD (Rural Development) Projects 2020-21 from IRG</td><td><a href="https://docs.google.com/spreadsheets/d/1K7s1ik24b7boK2e2BWFdBPlaVVCviB584cvddV2Xm1k/edit#gid=907903904">RD (Rural Development) Projects 2020-21 from IRG</a></td></tr>
<tr><td>Receivables & Bank Statements 2022-23 & 2021-22</td><td><a href="https://docs.google.com/spreadsheets/d/1_UePkP7uj9TBOd-T9Hdod9INWbSk3eS8eOnmo-ECVBA/edit#gid=0">Receivables & Bank Statements 2022-23 & 2021-22</a></td></tr>
<tr><td>Seed Grants Balances from R&D</td><td><a href="https://docs.google.com/spreadsheets/d/18hvSMOxEv7sEIQRSaiwlJabhHlcv996yDxOvGtuaF6s/edit#gid=0">Seed Grants Balances from R&D</a></td></tr>
<tr><td>Software Subscription Charges</td><td><a href="https://docs.google.com/spreadsheets/d/1pcMyUSjqiZ-07ko715FnYwmEzg-4PUQ5MJ6KPU0dTxI/edit#gid=0">Software Subscription Charges</a></td></tr>
<tr><td>Sports related expenses</td><td><a href="https://docs.google.com/spreadsheets/d/10HWwVm8X9_rnv1ryPfNwd3emzwbsf2el4KNFvCgwd1Y/edit#gid=0">Sports related expenses</a></td></tr>
<tr><td>Transport and Institute Vehicle Maintenance</td><td><a href="https://docs.google.com/spreadsheets/d/11hP2zclk3-u5QdOmfQgFXXwL_crebtaF7bMV-5Z0ig0/edit#gid=0">Transport and Institute Vehicle Maintenance</a></td></tr>
<tr><td><b>Vendors</td></b><td></td></tr>
<tr><td>Compliance Check for Section 206AB & 206CCA</td><td><a href="https://docs.google.com/spreadsheets/d/1UHHjL7o9gqWbR6-YFbBkK8tUK5g-Fc17/edit#gid=930673177">Compliance Check for Section 206AB & 206CCA</a></td></tr>
<tr><td>Bharat Petrolum Corporation Limited FY 2022-23</td><td><a href="https://docs.google.com/spreadsheets/d/1ttITw4GqgsNKRmRa--UpRxvBKprGesDV98ERjzXkGqQ/edit#gid=0">Bharat Petrolum Corporation Limited FY 2022-23</a></td></tr>
<tr><td>Eros Furniture Pvt Ltd</td><td><a href="https://docs.google.com/spreadsheets/d/1qJMkGd0WxaOEWFacPPekOtO7vJyAxX_owxEi47kvJkU/edit#gid=0">Eros Furniture Pvt Ltd</a></td></tr>
<tr><td>M/s Khandelwal and Khandelwal 2022/3019</td><td><a href="https://docs.google.com/spreadsheets/d/1oaL0FJEQEidJfhp-6iF7e0CNTljzXTXJnLkdO0iQkTM/edit#gid=0">M/s Khandelwal and Khandelwal 2022/3019</a></td></tr>
<tr><td>NIKOM INFRA SOLUTIONS PVT LTD</td><td><a href="https://docs.google.com/spreadsheets/d/1Hx-Lq6bCyyU9JDXPtRQudDKQH_nbBYcE/edit#gid=1414966051">NIKOM INFRA SOLUTIONS PVT LTD</a></td></tr>
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection