
   <div class="app-sidebar colored">
      <div class="sidebar-header">
          <a class="header-brand" href="index.html">
              <div class="logo-img">
                  <img src="{{ URL::to('images/Judiciary-Logo.png') }}" class="header-brand-img" alt="lavalite" style="height:30px; width:30px;">
              </div>
              <span class="text">e-WAKILI</span>
          </a>
          <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
          <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
      </div>

      <div class="sidebar-content">
          <div class="nav-container">
              <nav id="main-menu-navigation" class="navigation-main">
                  <div class="nav-lavel">Navigation</div>
                  <div @if(\Request::is('auth/dashboard')) class="nav-item active" @endif class="nav-item">
                      <a href="{{ url('auth/dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                  </div>

                  <div @if(\Request::is('advocate/roll')) class="nav-item active" @endif class="nav-item">
                      <a href="{{ url('advocate/roll') }}"><i class="ik ik-users"></i><span>Roll of Advocates</span></a>
                  </div>

                  <div class="nav-lavel">Petition for Admission</div>

                  <div @if(\Request::is('sessions/petition-session') ||
                        \Request::is('sessions/pending-admission')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-repeat"></i><span>Sessions Management</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('sessions/petition-session')) class="menu-item active" @endif href="{{ url('sessions/petition-session') }}" class="menu-item">Petition Sessions </a>
                          <a @if(\Request::is('sessions/pending-admission')) class="menu-item active" @endif href="{{ url('sessions/pending-admission') }}" class="menu-item">Pending Admission </a>
                      </div>
                  </div>

                  <div @if(\Request::is('petition/under-review') ||
                        \Request::is('petition/rhc-review') ||
                        \Request::is('petition/cle-inspection') ||
                        \Request::is('petition/cj-appearance') ||
                        \Request::is('petition/new-applicant')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Petition Applications</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('petition/under-review')) class="menu-item active" @endif href="{{ url('petition/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('petition/rhc-review')) class="menu-item active" @endif href="{{ url('petition/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('petition/cle-inspection')) class="menu-item active" @endif href="{{ url('petition/cle-inspection') }}" class="menu-item">CLE Inspection </a>
                          <a @if(\Request::is('petition/cj-appearance')) class="menu-item active" @endif href="{{ url('petition/cj-appearance') }}" class="menu-item">CJ Appearance </a>
                          <a @if(\Request::is('petition/new-applicant')) class="menu-item active" @endif href="{{ url('petition/new-applicant') }}" class="menu-item">New Applicants </a>
                      </div>
                  </div>

                  <div @if(\Request::is('petition-resume/rhc-inspection') ||
                        \Request::is('petition-resume/cle-approval') ||
                        \Request::is('petition-resume/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Resume Petition</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('petition-resume/rhc-inspection')) class="menu-item active" @endif href="{{ url('petition-resume/rhc-inspection') }}" class="menu-item">RHC Inspection </a>
                          <a @if(\Request::is('petition-resume/cle-approval')) class="menu-item active" @endif href="{{ url('petition-resume/cle-approval') }}" class="menu-item">CLE Approval </a>
                          <a @if(\Request::is('petition-resume/cj-approval')) class="menu-item active" @endif href="{{ url('petition-resume/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('miscellaneous/postponed') ||
                        \Request::is('miscellaneous/deferred') ||
                        \Request::is('miscellaneous/objected') ||
                        \Request::is('miscellaneous/abandoned')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Miscellaneous</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('miscellaneous/postponed')) class="menu-item active" @endif href="{{ url('miscellaneous/postponed') }}" class="menu-item">Postponed </a>
                          <a @if(\Request::is('miscellaneous/deferred')) class="menu-item active" @endif href="{{ url('miscellaneous/deferred') }}" class="menu-item">Deferred </a>
                          <a @if(\Request::is('miscellaneous/objected')) class="menu-item active" @endif href="{{ url('miscellaneous/objected') }}" class="menu-item">Objected </a>
                          <a @if(\Request::is('miscellaneous/abandoned')) class="menu-item active" @endif href="{{ url('miscellaneous/abandoned') }}" class="menu-item">Abandoned </a>
                      </div>
                  </div>

                  <div @if(\Request::is('firm/pending') ||
                        \Request::is('firm/approved')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-repeat"></i><span>Firms & Workplaces</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('firm/pending')) class="menu-item active" @endif href="{{ url('firm/pending') }}" class="menu-item">Pending Approval </a>
                          <a @if(\Request::is('firm/approved')) class="menu-item active" @endif href="{{ url('firm/approved') }}" class="menu-item">Approved Firms </a>
                      </div>
                  </div>

                  <div class="nav-lavel">Permit Applications</div>


                  <div @if(\Request::is('out-of-time/under-review') ||
                        \Request::is('out-of-time/rhc-review') ||
                        \Request::is('out-of-time/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Late Renewals</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('out-of-time/under-review')) class="menu-item active" @endif href="{{ url('out-of-time/under-review') }}" class="menu-item">Under Reveiw </a>
                          <a @if(\Request::is('out-of-time/rhc-review')) class="menu-item active" @endif href="{{ url('out-of-time/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('out-of-time/cj-approval')) class="menu-item active" @endif href="{{ url('out-of-time/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('resume/under-review') ||
                        \Request::is('resume/rhc-review') ||
                        \Request::is('resume/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Resume Practising</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('resume/under-review')) class="menu-item active" @endif href="{{ url('resume/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('resume/rhc-review')) class="menu-item active" @endif href="{{ url('resume/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('resume/cj-approval')) class="menu-item active" @endif href="{{ url('resume/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('suspend/under-review') ||
                        \Request::is('suspend/rhc-review') ||
                        \Request::is('suspend/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Suspending</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('suspend/under-review')) class="menu-item active" @endif href="{{ url('suspend/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('suspend/rhc-review')) class="menu-item active" @endif href="{{ url('suspend/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('suspend/cj-approval')) class="menu-item active" @endif href="{{ url('suspend/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('non-practising/under-review') ||
                        \Request::is('non-practising/rhc-review') ||
                        \Request::is('non-practising/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>None Practising</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('non-practising/under-review')) class="menu-item active" @endif href="{{ url('non-practising/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('non-practising/rhc-review')) class="menu-item active" @endif href="{{ url('non-practising/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('non-practising/cj-approval')) class="menu-item active" @endif href="{{ url('non-practising/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('retire/under-review') ||
                        \Request::is('retire/under-review') ||
                        \Request::is('retire/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Retiring</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('retire/under-review')) class="menu-item active" @endif href="{{ url('retire/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('retire/under-review')) class="menu-item active" @endif href="{{ url('retire/under-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('retire/cj-approval')) class="menu-item active" @endif href="{{ url('retire/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('not-profit/under-review') ||
                        \Request::is('not-profit/rhc-review') ||
                        \Request::is('not-profit/cj-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Not for Profit</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('not-profit/under-review')) class="menu-item active" @endif href="{{ url('not-profit/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('not-profit/rhc-review')) class="menu-item active" @endif href="{{ url('not-profit/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('not-profit/cj-approval')) class="menu-item active" @endif href="{{ url('not-profit/cj-approval') }}" class="menu-item">CJ Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('name-change/under-review') ||
                        \Request::is('name-change/rhc-review') ||
                        \Request::is('name-change/jk-approval')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Name Change</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('name-change/under-review')) class="menu-item active" @endif href="{{ url('name-change/under-review') }}" class="menu-item">Under Review </a>
                          <a @if(\Request::is('name-change/rhc-review')) class="menu-item active" @endif href="{{ url('name-change/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('name-change/jk-approval')) class="menu-item active" @endif href="{{ url('name-change/kj-approval') }}" class="menu-item">JK Approval </a>
                      </div>
                  </div>

                  <div @if(\Request::is('temp-admission/new-application') ||
                        \Request::is('temp-admission/rhc-review') ||
                        \Request::is('temp-admission/cj-approval') ||
                        \Request::is('temp-admission/temp-advocates')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Temporary Admission</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('temp-admission/new-application')) class="menu-item active" @endif href="{{ url('temp-admission/new-application') }}" class="menu-item">New Applications </a>
                          <a @if(\Request::is('temp-admission/rhc-review')) class="menu-item active" @endif href="{{ url('temp-admission/rhc-review') }}" class="menu-item">RHC Review </a>
                          <a @if(\Request::is('temp-admission/cj-approval')) class="menu-item active" @endif href="{{ url('temp-admission/cj-approval') }}" class="menu-item">CJ Approval </a>
                          <a @if(\Request::is('temp-admission/temp-advocates')) class="menu-item active" @endif href="{{ url('temp-admission/temp-advocates') }}" class="menu-item">Temporary Advocates </a>
                      </div>
                  </div>

                  <div @if(\Request::is('trace-application/petition') ||
                        \Request::is('trace-application/permit') ||
                        \Request::is('trace-application/temp-admission') ||
                        \Request::is('trace-application/resume-petition')
                        )
                       class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Application Tracking</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('trace-application/petition')) class="menu-item active" @endif href="{{ url('trace-application/petition') }}" class="menu-item">Petition Applications </a>
                          <a @if(\Request::is('trace-application/permit')) class="menu-item active" @endif href="{{ url('trace-application/permit') }}" class="menu-item">Permit Requests </a>
                          <a @if(\Request::is('trace-application/temp-admission')) class="menu-item active" @endif href="{{ url('trace-application/temp-admission') }}" class="menu-item">TempAdmissions </a>
                          <a @if(\Request::is('trace-application/resume-petition')) class="menu-item active" @endif href="{{ url('trace-application/resume-petition') }}" class="menu-item">Resume Petition </a>
                      </div>
                  </div>

                  <div @if(\Request::is('bills/pending') ||
                        \Request::is('bills/paid') ||
                        \Request::is('bills/cancelled') ||
                        \Request::is('bills/expired') ||
                        \Request::is('bills/reconciliation')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-clipboard"></i><span>Payments & Bills</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('bills/pending')) class="menu-item active" @endif href="{{ url('bills/pending') }}" class="menu-item">Pending </a>
                          <a @if(\Request::is('bills/paid')) class="menu-item active" @endif href="{{ url('bills/paid') }}" class="menu-item">Paid </a>
                          <a @if(\Request::is('bills/cancelled')) class="menu-item active" @endif href="{{ url('bills/cancelled') }}" class="menu-item">Cancelled </a>
                          <a @if(\Request::is('bills/expired')) class="menu-item active" @endif href="{{ url('bills/expired') }}" class="menu-item">Expired </a>
                          <a @if(\Request::is('bills/reconciliation')) class="menu-item active" @endif href="{{ url('bills/reconciliation') }}" class="menu-item">Cancelled </a>
                      </div>
                  </div>

                  <div class="nav-lavel">Reports & Settings</div>

                  <div @if(\Request::is('manage/personal-details') ||
                        \Request::is('manage/qualifications') ||
                        \Request::is('manage/experience') ||
                        \Request::is('manage/lst') ||
                        \Request::is('manage/firm') ||
                        \Request::is('manage/add-firm') ||
                        \Request::is('manage/finish')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-layers"></i><span>Reports</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('manage/personal-details')) class="menu-item active" @endif href="{{ url('manage/personal-details') }}" class="menu-item">Statistical Reports </a>
                          <a @if(\Request::is('manage/qualifications')) class="menu-item active" @endif href="{{ url('manage/qualifications') }}" class="menu-item">Petition Report </a>
                          <a @if(\Request::is('manage/attachments')) class="menu-item active" @endif href="{{ url('manage/attachments') }}" class="menu-item">Permit Reports </a>
                          <a @if(\Request::is('manage/llb')) class="menu-item active" @endif href="{{ url('manage/llb') }}" class="menu-item">Advocate Report </a>
                          <a @if(\Request::is('manage/lst')) class="menu-item active" @endif href="{{ url('manage/lst') }}" class="menu-item">Temporary Admission Reports </a>
                          <a @if(\Request::is('manage/experience')) class="menu-item active" @endif href="{{ url('manage/experience') }}" class="menu-item">Revenue Collection </a>
                      </div>
                  </div>

                  <div @if(\Request::is('user-management/role') ||
                        \Request::is('user-management/permission') ||
                        \Request::is('user-management/user') ||
                        \Request::is('user-management/cle') ||
                        \Request::is('user-management/role/add') ||
                        \Request::is('user-management/adv-committee') ||
                        \Request::is('user-management/legal-professional') ||
                        \Request::is('user-management/profile')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-user"></i><span>User Management</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('user-management/role') || \Request::is('user-management/role/add')) class="menu-item active" @endif href="{{ url('user-management/role') }}" class="menu-item">Roles </a>
                          <a @if(\Request::is('user-management/permission')) class="menu-item active" @endif href="{{ url('user-management/permission') }}" class="menu-item">Permissions </a>
                          <a @if(\Request::is('user-management/user')) class="menu-item active" @endif href="{{ url('user-management/user') }}" class="menu-item">Users </a>
                          <a @if(\Request::is('user-management/cle')) class="menu-item active" @endif href="{{ url('user-management/cle') }}" class="menu-item">CLE </a>
                          <a @if(\Request::is('user-management/adv-committee')) class="menu-item active" @endif href="{{ url('user-management/adv-committee') }}" class="menu-item">Advocate Committee </a>
                          <a @if(\Request::is('user-management/legal-professional')) class="menu-item active" @endif href="{{ url('user-management/legal-professional') }}" class="menu-item">Legal Professionals </a>
                          <a @if(\Request::is('user-management/profile')) class="menu-item active" @endif href="{{ url('user-management/profile') }}" class="menu-item">Profile </a>
                      </div>
                  </div>

                  <div @if(\Request::is('settings/advocate-category') ||
                        \Request::is('settings/request-type') ||
                        \Request::is('settings/region') ||
                        \Request::is('settings/petition-session')||
                        \Request::is('settings/venue')||
                        \Request::is('settings/district')
                        )
                        class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-clipboard"></i><span>Master Data</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('settings/advocate-category')) class="menu-item active" @endif href="{{ url('settings/advocate-category') }}" class="menu-item">Advocate Category </a>
                          <a @if(\Request::is('settings/request-type')) class="menu-item active" @endif href="{{ url('settings/request-type') }}" class="menu-item">Request Types </a>
                          <a @if(\Request::is('settings/region')) class="menu-item active" @endif href="{{ url('settings/region') }}" class="menu-item">Region </a>
                          <a @if(\Request::is('settings/district')) class="menu-item active" @endif href="{{ url('settings/district') }}" class="menu-item">District </a>
                          <a @if(\Request::is('settings/petition-session')) class="menu-item active" @endif href="{{ url('settings/petition-session') }}" class="menu-item">Petition Sessions </a>
                          <a @if(\Request::is('settings/venue')) class="menu-item active" @endif href="{{ url('settings/venue') }}" class="menu-item">Appearance Venue </a>
                      </div>
                  </div>

                  <div class="nav-item">
                      <a href="{{ url('system/logs') }}"><i class="ik ik-paperclip"></i><span>System Logs</span></a>
                  </div>

              </nav>
          </div>
      </div>
  </div>
