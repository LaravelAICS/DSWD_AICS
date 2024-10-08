<div>
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($showTable == true)
            <div class="card my-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0 font-weight-bold text-primary">Document ({{ $totalDocuments }})</h3>
                        <button class="btn btn-success" wire:click='showForm'>
                            <span wire:loading.remove wire:target='showForm'>File Upload</span>
                            <span wire:loading wire:target='showForm'><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="input-group mb-3" style="width:50%">
                    <input type="text" wire:model="search" class="form-control" placeholder="Search..." wire:keydown.enter="performSearch">
                    <div class="input-group-append align-items-center">
                        <button wire:click="performSearch" class="btn btn-primary">Search</button>
                        <!-- Notification button to open the modal -->
                        <button class="btn btn-success position-relative" data-toggle="modal" data-target="#notificationModal">
                            <i class="fas fa-bell"></i>
                            @if ($unreadAlertsCount > 0)
                                <span class="badge badge-danger badge-sm position-absolute top-0 end-0">{{ $unreadAlertsCount }}</span>
                            @endif
                        </button>
                        <!-- Generate Report button -->
                        <a wire:click.prevent="generateExcelReport" href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>
                </div>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                            <thead>
                                <tr style="background-color: #4e73df; color: #ffffff;">
                                    <th class="align-middle" style="width: 12%;">
                                        <div style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Document References Number</span>
                                        </div>
                                    </th>
                                    <th class="align-middle" style="width: 10%;">
                                        <div wire:click="sortBy('filetype')" style="cursor: pointer; color: #ffffff; display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Record Series</span>
                                            @if ($sortField === 'filetype')
                                                <span>{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                                            @else
                                                <span>&nbsp;</span>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle" style="width: 15%;">Records Titile and Description</th>
                                    <th class="align-middle" style="width: 15%;">
                                        <div wire:click="sortBy('inclusive_dates')" style="cursor: pointer; color: #ffffff; display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Period Covered Inclusive Date</span>
                                            @if ($sortField === 'inclusive_dates')
                                                <span>{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                                            @else
                                                <span>&nbsp;</span>
                                            @endif
                                    </th>
                                    <th class="align-middle" style="width: 8%;">Volume</th>
                                    <th class="align-middle" style="width: 10%;">Records Medium</th>
                                    <th class="align-middle" style="width: 8%;">
                                        <div wire:click="sortBy('restrictions')" style="cursor: pointer; color: #ffffff; display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Restrictions</span>
                                            @if ($sortField === 'restrictions')
                                                <span>{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                                            @else
                                                <span>&nbsp;</span>
                                            @endif

                                    </th>
                                    <th class="align-middle" style="width: 10%;">Records Location</th>
                                    <th class="align-middle" style="width: 10%;">
                                        <div wire:click="sortBy('doctype')" style="cursor: pointer; color: #ffffff; display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Time Value</span>
                                            @if ($sortField === 'doctype')
                                                <span>{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                                            @else
                                                <span>&nbsp;</span>
                                            @endif
                                    </th>
                                    <th class="align-middle" style="width: 11%;">
                                        <div style="cursor: pointer; color: #ffffff; display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Retention Period</span>
                                    </th>
                                    <th class="align-middle" style="width: 9%;">Download</th>
                                    <th class="align-middle" style="width: 9%;">Delete</th>
                                    <th class="align-middle" style="width: 9%;">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                            <tr>
                                <td>{{ $document->reference_num }}</td>{{--1 referencenumber --}}
                                <td>{{ $document->filetype }}</td>{{--1 File Type --}}
                                <td>
                                    <a href="#" wire:click="showDocumentDetails({{ $document->id }})" style="text-decoration: underline; cursor: pointer;">
                                        {{ $document->document }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($document->inclusive_dates)->toDateString() }}</td>
                                <td>{{ $document->volume }}</td>{{-- 5Records Volume --}}
                                <td>{{ $document->records_medium }}</td>{{-- 6Records Midium --}}
                                <td>{{ $document->restrictions}}</td>{{-- 8Documents Restrictions --}}
                                <td>{{ $document->records_location}}</td>{{--7 Documents Located --}}
                                <td>{{ $document->doctype }}</td>{{-- 3Document type --}}
                                <td>{{ $document->due_date ? \Carbon\Carbon::parse($document->due_date)->toDateString() : 'Permanent' }}</td>
                                <td class="text-center">
                                    <button wire:click="downloadfile({{ $document->id }})"
                                        class="btn btn-success btn-sm">Download</button>
                                </td>
                                <td class="text-center">
                                @if($document->doctype == 'Temporary')
                                    <button wire:click="deleteDocument({{ $document->id }})" class="btn btn-danger btn-sm">Delete</button>
                                @endif
                            </td>
                                <td class="text-center">
                                    <button wire:click="editReferenceNumber({{ $document->id }})" class="btn btn-info btn-sm">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="20" class="text-center">
                                    <h4 class="text-center">Document Not Found</h4>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    @if(count($documents))
                        {{ $documents->links('livewire-pagination-links') }}
                    @endif
                </div>
            </div>
        @endif
        @if ($createForm == true)
        <div class="container my-4">
            <button class="btn btn-success" wire:click='goBack'>
                <span wire:loading.remove wire:target='goBack'>
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span wire:loading wire:target='goBack'>
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
                <form wire:submit.prevent='save'>
                    <div class="form-group my-1">
                        <label for="volume">Enter Reference Number</label>
                        <input type="number" wire:model='reference_num' class="form-control" id="filetype" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" required>
                        @error('reference_num')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group my-1">
                    <label for="records_location">Select Location Records</label>
                    <select wire:model='records_location' class="form-control" id="records_location" required>
                        <option value="">Select Location</option>
                        <option value="Warehouse">DSWD Field Office XI</option>
                        @foreach ($locationOptions as $location)
                            @if ($location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-1">
                    <label for="restrictions">Select Document Restrictions</label>
                    <select wire:model="restrictions" class="form-control" id="filetype" required>
                        <option value="">Select Document Restrictions</option>
                        <option value="Open Access">Open Access</option>
                        <option value="Restricted Records">Restricted Records</option>
                        @foreach ($restrictOptions as $restrict)
                            @if ($restrict)
                                <option value="{{ $restrict }}">{{ $restrict }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-1">
                    <label for="records_medium">Enter Records Medium</label>
                    <input type="text" wire:model='records_medium' class="form-control" id="filetype" required>
                </div>

                    <div class="form-group my-1">
                        <label for="volume">Enter Volume</label>
                        <input type="number" wire:model='volume' class="form-control" id="filetype" required>
                        @error('Volume')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group my-1">
                        <label for="">Select Inclusive Dates</label>
                        <input type="date" wire:model='inclusive_dates' class="form-control" required>
                    </div>

                    <div class="form-group my-2">
                        <label for="description" class="mb-1">Description</label>
                        <textarea rows="4" wire:model='description' class="form-control" id="filetype"></textarea>
                    </div>
            </div>

            <div class="col-md-6">
                    <div class="form-group my-1">
                        <label for="filetype">Select File Type</label>
                        <select wire:model="filetype" class="form-control" id="filetype" required>
                            <option value="">Select File Type</option>
                            <option value="Administrative">Administrative</option>
                            <option value="Financial">Financial</option>
                            <option value="LegalRecords">Legal RecordS</option>
                            <option value="PersonnelRecords">Personnel Records</option>
                            <option value="SocialServices">Social Services</option>
                            @foreach ($fileOptions as $file)
                            @if ($file)
                                <option value="{{ $file }}">{{ $file }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @if ($filetype == 'Administrative')
                    <div class="form-group my-1">
                        <label for="administrativeType">Select Administrative Type</label>
                        <select wire:model='administrativeType' class="form-control selectpicker" id="administrativeType" data-live-search="true" required>
                            <option value="">Select Administrative Type</option>
                            <option value="Accommodation Billeting">Accommodation / Billeting</option>
                            <option value="Audit Management Files">Audit Management Files</option>
                            <option value="Bills of Materials Estimates">Bills of Materials and Estimates</option>
                            <option value="Business Process Requirement Analysis">Business Process and Requirement Analysis</option>
                            <option value="Certificates">Certificates</option>
                            <option value="Citizens Charter">Citizens Charter</option>
                            <option value="Clearances">Clearances</option>
                            <option value="Food Non-Food Item Tally Sheets">Food and Non-Food Item Tally Sheets</option>
                            <option value="Insurance Files">Insurance Files</option>
                            <option value="Permits Building">Permits (Building)</option>
                            <option value="Permits Demolition">Permits (Demolition)</option>
                            <option value="Permits Electrical">Permits (Electrical)</option>
                            <option value="Permits Tree Balling Cutting">Permits (Tree Balling or Cutting)</option>
                            <option value="Plans Building">Plans (Building - Design & Layout)</option>
                            <option value="Plans Information Systems Strategic">Plans (Information Systems Strategic)</option>
                            <option value="Plans Site Development">Plans (Site Development)</option>
                            <option value="Plans Survey">Plans (Survey)</option>
                            <option value="Registry Return Receipt">Registry Return Receipt/Registry Card</option>
                            <option value="Reports ICT">Reports (Information and Communications Technology - ICT)</option>
                            <option value="Reports Inspection Acceptance">Reports (Inspection and Acceptance)</option>
                            <option value="Reports Inspection Sale Unserviceable Properties">Reports (Inspection of Sale of Unserviceable Properties)</option>
                            <option value="Reports Inspection Monitoring Storage Facilities">Reports (Inspection & Monitoring of Storage Facilities - Records/Supply/Equipment)</option>
                            <option value="Reports Property Transfer">Reports (Property Transfer)</option>
                            <option value="Reports Terminal Utilities">Reports (Terminal Utilities - Cable/Communication/Electricity/Fuel/Gasoline/Water)</option>
                            <option value="Slips Equipment Property Supply">Slips (Equipment/Property/Supply)</option>
                            <option value="Furniture Equipment Movement">Furniture & Equipment Movement</option>
                            <option value="Gasoline Consumption">Gasoline Consumption</option>
                            <option value="Inventory Custodian">Inventory Custodian</option>
                            <option value="Production Repacking Supply">Production/Repacking Supply</option>
                            <option value="Survey Files Client Satisfaction">Survey Files (Client Satisfaction/Customer Feedback)</option>
                            <option value="Survey Files Consolidated Reports">Survey Files (Consolidated Reports/Results)</option>
                            <option value="Transmittal Sheet">Transmittal Sheet</option>
                            @foreach ($administrativeOptions as $administrative)
                            @if ($administrative)
                                <option value="{{ $administrative }}">{{ $administrative }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @endif


                    @if ($filetype == 'Financial')
                    <div class="form-group my-1">
                        <label for="financialType">Select Financial Type</label>
                        <select wire:model='financialType' class="form-control selectpicker" id="financialType" data-live-search="true" required>
                            <option value="">Select Financial Type</option>
                            <option value="Audit Observation Memoranda">Audit Observation Memoranda</option>
                            <option value="Authority to Debit Account">Authority to Debit Account</option>
                            <option value="Bank Reconciliation">Bank Reconciliation</option>
                            <option value="Budget Justifications">Budget Justifications</option>
                            <option value="Budget Proposal">Budget Proposal</option>
                            <option value="Demand Letters">Demand Letters</option>
                            <option value="Fund Releases">Fund Releases</option>
                            <option value="Lists Due and Demandable Accounts">Lists (Due and Demandable Accounts Payable - Advice to Debit Accounts LDDAP-ADA)</option>
                            <option value="Lists Funded Projects">Lists (Funded Projects)</option>
                            <option value="Loans Agreement">Loans Agreement</option>
                            <option value="Notices Approved Payroll Action">Notices (Approved Payroll Action NAPA)</option>
                            <option value="Notices Collection of Unpaid Accounts">Notices (Collection of Unpaid Accounts)</option>
                            <option value="Physical and Financial Accomplishments">Physical and Financial Accomplishments (Cue Cards)</option>
                            <option value="Reports Audit Financial Statement">Reports (Audit Financial Statement)</option>
                            <option value="Reports Financial Report of Operation">Reports (Financial Report of Operation)</option>
                            <option value="Reports Fund Utilization">Reports (Fund Utilization)</option>
                            <option value="Reports Service Fee">Reports (Service Fee)</option>
                            <option value="Reports Status of Funds">Reports (Status of Funds)</option>
                            <option value="Reports Treasury Warrants Issued & Cancelled">Reports (Treasury Warrants Issued & Cancelled)</option>
                            <option value="Request for Fund Files Realignment">Request for Fund Files (Realignment)</option>
                            <option value="Request for Fund Files Release">Request for Fund Files (Release)</option>
                            <option value="Request for Fund Files Transfer">Request for Fund Files (Transfer)</option>
                            <option value="Request for Fund Files Utilization">Request for Fund Files (Utilization)</option>
                            <option value="Statements Breakdown of Fixed Assets">Statements (Breakdown of Fixed Assets)</option>
                            <option value="Statements Local and Foreign Donations">Statements (Local and Foreign Donations)</option>
                            <option value="Statements Releases">Statements (Releases)</option>
                            <option value="Statements Treasury Reconciliation and Current Account">Statements (Treasury Reconciliation and Current Account)</option>
                            @foreach ($financialOptions as $financial)
                            @if ($financial)
                                <option value="{{ $financial }}">{{ $financial }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @if ($filetype == 'LegalRecords')
                    <div class="form-group my-1">
                        <label for="legalrecordsType">Select Legal Records Type</label>
                        <select wire:model='legalrecordsType' class="form-control selectpicker" id="legalrecordsType" data-live-search="true" required>
                            <option value="">Select Legal Records Type</option>
                            <option value="Affidavit of Loss">Affidavit of Loss</option>
                            <option value="Repatriation">Repatriation</option>
                            <option value="Affidavit of Undertaking">Affidavit of Undertaking</option>
                            <option value="Authority to Escort">Authority to Escort</option>
                            <option value="Case Tapes/Documentary Films">Case Tapes/Documentary Films</option>
                            <option value="Proceedings">Proceedings</option>
                            <option value="Complaints/Protests">Complaints/Protests</option>
                            <option value="Subpoenas">Subpoenas</option>
                            <option value="Ad Testificandum">Ad Testificandum</option>
                            <option value="Duces Tecum">Duces Tecum</option>
                            @foreach ($legalOptions as $legal)
                            @if ($legal)
                                <option value="{{ $legal }}">{{ $legal }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @endif


                    @if ($filetype == 'PersonnelRecords')
                    <div class="form-group my-1">
                        <label for="personnelrecordsType">Select Personnel Records Type</label>
                        <select wire:model='personnelrecordsType' class="form-control selectpicker" id="personnelrecordsType" data-live-search="true" required>
                            <option value="">Select Personnel Records Type</option>
                            <option value="Applications">Applications</option>
                            <option value="Employment/Position">Employment/Position</option>
                            <option value="Leave of Absence">Leave of Absence</option>
                            <option value="Certificates of Appearance">Certificates of Appearance</option>
                            <option value="Charts">Charts</option>
                            <option value="Functional">Functional</option>
                            <option value="Organization">Organization</option>
                            <option value="Contracts of Service">Contracts of Service</option>
                            <option value="Daily Time Records (CS Form 48)">Daily Time Records (CS Form 48)</option>
                            <option value="Directories of Officials/Employees">Directories of Officials/Employees</option>
                            <option value="Employees Exit Interview Reports">Employees Exit Interview Reports</option>
                            <option value="Employees Index Cards">Employees Index Cards</option>
                            <option value="GSIS, Medicare/Pag-ibig Memberships">GSIS, Medicare/Pag-ibig Memberships</option>
                            <option value="Leave Credit Cards">Leave Credit Cards</option>
                            <option value="List Eligible">List Eligible</option>
                            <option value="Person with Disability (PWD) Profiler">Person with Disability (PWD) Profiler</option>
                            <option value="Older Person (OP) Roster List">Older Person (OP) Roster List</option>
                            <option value="Performance Appraisal/Evaluation Rating Files">Performance Appraisal/Evaluation Rating Files</option>
                            <option value="Performance Contracts">Performance Contracts</option>
                            <option value="Performance Target Worksheets">Performance Target Worksheets</option>
                            <option value="Personnel Comparative Assessment Forms">Personnel Comparative Assessment Forms</option>
                            <option value="Personal Data Sheets/ Curriculum Vitae">Personal Data Sheets/ Curriculum Vitae</option>
                            <option value="Personnel Folders (201 Files)">Personnel Folders (201 Files)</option>
                            <option value="Appointment">Appointment</option>
                            <option value="Approval for Resignation/Retirement/Transfer">Approval for Resignation/Retirement/Transfer</option>
                            <option value="Award/Commendation">Award/Commendation</option>
                            <option value="Certification">Certification</option>
                            <option value="Employment">Employment</option>
                            <option value="Service">Service</option>
                            <option value="Change of Civil Status/Name">Change of Civil Status/Name</option>
                            <option value="Clearance">Clearance</option>
                            <option value="Delegation/Detail">Delegation/Detail</option>
                            <option value="Incentive">Incentive</option>
                            <option value="Marriage Contract">Marriage Contract</option>
                            <option value="Medical Certificate in support of absence on account of illness/maternity">Medical Certificate in support of absence on account of illness/maternity</option>
                            <option value="Notice of Salary Adjustment">Notice of Salary Adjustment</option>
                            <option value="Oath of Office">Oath of Office</option>
                            <option value="Personal Date Sheet (first and lates only)">Personal Date Sheet (first and lates only)</option>
                            <option value="Service Record">Service Record</option>
                            <option value="Training & Career Development (Local & Foreign)">Training & Career Development (Local & Foreign)</option>
                            <option value="Plantillas of Personnel">Plantillas of Personnel</option>
                            <option value="Position Classification Papers">Position Classification Papers</option>
                            <option value="Job Description">Job Description</option>
                            <option value="Notice of Classification Action">Notice of Classification Action</option>
                            <option value="Request for Classification">Request for Classification</option>
                            <option value="Recommendations for Employment">Recommendations for Employment</option>
                            <option value="Request Approval on Promotion">Request Approval on Promotion</option>
                            <option value="Change of Status">Change of Status</option>
                            <option value="Reinstatement">Reinstatement</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Request for Accumulated Leave Credits">Request for Accumulated Leave Credits</option>
                            <option value="Statements of Assests, Liabilities and Net Worth">Statements of Assests, Liabilities and Net Worth</option>
                            <option value="Training Files">Training Files</option>
                            <option value="Action Plan of Trainee">Action Plan of Trainee</option>
                            <option value="Attendance Sheet">Attendance Sheet</option>
                            <option value="Calendar Course Outline">Calendar Course Outline</option>
                            <option value="Design">Design</option>
                            <option value="Plan">Plan</option>
                            <option value="Program">Program</option>
                            <option value="Report">Report</option>
                            <option value="Syllabus">Syllabus</option>
                            @foreach ($personnelOptions as $personnel)
                            @if ($personnel)
                                <option value="{{ $personnel }}">{{ $personnel }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @if ($filetype == 'SocialServices')
                    <div class="form-group my-1">
                        <label for="socialservicesType">Select Social Services Type</label>
                        <select wire:model='socialservicesType' class="form-control selectpicker" id="socialservicesType" data-live-search="true" required>
                            <option value="">Select Social Services Type</option>
                            <option value="Adoption Files">Adoption Files</option>
                            <option value="Adoption Decree">Adoption Decree</option>
                            <option value="Affidavit of Consent">Affidavit of Consent</option>
                            <option value="Birth Certificate">Birth Certificate</option>
                            <option value="Case Study (Adoptive parents/child)">Case Study (Adoptive parents/child)</option>
                            <option value="Certificate of Founding">Certificate of Founding</option>
                            <option value="Clearance">Clearance</option>
                            <option value="Court Decision">Court Decision</option>
                            <option value="Death Certificate">Death Certificate</option>
                            <option value="Decree of Abandonment">Decree of Abandonment</option>
                            <option value="Deed of Voluntary Commitment">Deed of Voluntary Commitment</option>
                            <option value="Intercountry Adoption Clearance (ICA)">Intercountry Adoption Clearance (ICA)</option>
                            <option value="International Social Welfares Service for Filipino Nationals (per country)">International Social Welfares Service for Filipino Nationals (per country)</option>
                            <option value="Interview Sheet">Interview Sheet</option>
                            <option value="Marriage Certificate">Marriage Certificate</option>
                            <option value="Medical Record/History">Medical Record/History</option>
                            <option value="Picture">Picture</option>
                            <option value="Placement of Authority">Placement of Authority</option>
                            <option value="Progress Report">Progress Report</option>
                            <option value="Referral/Communication">Referral/Communication</option>
                            <option value="Applications">Applications</option>
                            <option value="Membership to Self-Employment Assistance-Kaunlaran (SEA-K)">Membership to Self-Employment Assistance-Kaunlaran (SEA-K)</option>
                            <option value="Solicitation Permit">Solicitation Permit</option>
                            <option value="Books">Books</option>
                            <option value="Brochures">Brochures</option>
                            <option value="Case Folders">Case Folders</option>
                            <option value="1 . Client">1 . Client</option>
                            <option value="1.1 Child Help Intervention Programs and Services (CHIPS/CHIMES)">1.1 Child Help Intervention Programs and Services (CHIPS/CHIMES)</option>
                            <option value="1.2 Elsie Gaches Village (EGV)">1.2 Elsie Gaches Village (EGV)</option>
                            <option value="1.3 Golden Acres (GA)">1.3 Golden Acres (GA)</option>
                            <option value="1.4 Haven for Children (HC)">1.4 Haven for Children (HC)</option>
                            <option value="1.5 Haven for Women (HW)">1.5 Haven for Women (HW)</option>
                            <option value="1.6 Jose Fabella Center (JFC)">1.6 Jose Fabella Center (JFC)</option>
                            <option value="1.7 Lingap Center (LC)">1.7 Lingap Center (LC)</option>
                            <option value="1.8 Malaya Center (MC)">1.8 Malaya Center (MC)</option>
                            <option value="1.9 Marillac Hills (MH)">1.9 Marillac Hills (MH)</option>
                            <option value="1.10 National Vocational and Rehabilitation Center (NVRC)">1.10 National Vocational and Rehabilitation Center (NVRC)</option>
                            <option value="1.11 Nayon ng Kabataan (NK)">1.11 Nayon ng Kabataan (NK)</option>
                            <option value="1.12 Reception and Study Center for Children (RSCC)">1.12 Reception and Study Center for Children (RSCC)</option>
                            <option value="1.13 Ragional Youth Development Center (RYDC)">1.13 Ragional Youth Development Center (RYDC)</option>
                            <option value="1.14 Rehabilitation Shelter Workshop (RSW)">1.14 Rehabilitation Shelter Workshop (RSW)</option>
                            <option value="1.15 Sanctuary Center (SC)">1.15 Sanctuary Center (SC)</option>
                            <option value="2. Minor">2. Minor</option>
                            <option value="2.1 Legal Guardianship">2.1 Legal Guardianship</option>
                            <option value="2.2 Youthful Offender">2.2 Youthful Offender</option>
                            <option value="Certificates">Certificates</option>
                            <option value="Client Eligibility">Client Eligibility</option>
                            <option value="Travel Issued to Minor">Travel Issued to Minor</option>
                            <option value="Control Logbooks of Minors Traveling Abroad">Control Logbooks of Minors Traveling Abroad</option>
                            <option value="Directories">Directories</option>
                            <option value="DSWD">DSWD</option>
                            <option value="Local Government Unit (LGU) Centers and Facilities">Local Government Unit (LGU) Centers and Facilities</option>
                            <option value="Non-Government Organization (NGO)">Non-Government Organization (NGO)</option>
                            <option value="Accredited">Accredited</option>
                            <option value="Licensed">Licensed</option>
                            <option value="Disaster Statistics">Disaster Statistics</option>
                            <option value="Foreign Donation Files">Foreign Donation Files</option>
                            <option value="Acceptance Letter">Acceptance Letter</option>
                            <option value="Certificate of Understanding">Certificate of Understanding</option>
                            <option value="Endorsement of Section 105 (1) to Licensed NGOs">Endorsement of Section 105 (1) to Licensed NGOs</option>
                            <option value="Import Declaration">Import Declaration</option>
                            <option value="Letter of Intent">Letter of Intent</option>
                            <option value="Note Verbale">Note Verbale</option>
                            <option value="Packing List">Packing List</option>
                            <option value="Plan of Distribution">Plan of Distribution</option>
                            <option value="Ready-to-Eat Food Regional Allocation/Releases">Ready-to-Eat Food Regional Allocation/Releases</option>
                            <option value="Report">Report</option>
                            <option value="Monthly Duties and Tax Availment">Monthly Duties and Tax Availment</option>
                            <option value="Ready-to-Eat Food Regional Production">Ready-to-Eat Food Regional Production</option>
                            <option value="Request for Tax Exemption of NGO">Request for Tax Exemption of NGO</option>
                            <option value="Licensed">Licensed</option>
                            <option value="Unlicensed">Unlicensed</option>
                            <option value="Trucking Forwarder's Monthly Stock Report">Trucking Forwarder's Monthly Stock Report</option>
                            <option value="Individual Casa Folders">Individual Casa Folders</option>
                            <option value="Women in Difficult Circumstances">Women in Difficult Circumstances</option>
                            <option value="Information Files">Information Files</option>
                            <option value="Article for Publication">Article for Publication</option>
                            <option value="Information/Education/Communication (Briefing Material, Video, Documentary, Casebook)">Information/Education/Communication (Briefing Material, Video, Documentary, Casebook)</option>
                            <option value="Speech/Talking Points">Speech/Talking Points</option>
                            <option value="LGU Reports">LGU Reports</option>
                            <option value="Accomplishment">Accomplishment</option>
                            <option value="Municipal Local Situationer">Municipal Local Situationer</option>
                            <option value="LGU Plans Social Welfare Development Programs and Services">LGU Plans Social Welfare Development Programs and Services</option>
                            <option value="License/Registration/Accreditation Files">License/Registration/Accreditation Files</option>
                            <option value="Application">Application</option>
                            <option value="Assessment Report">Assessment Report</option>
                            <option value="Certification of Accreditation/License">Certification of Accreditation/License</option>
                            <option value="Day Care Center">Day Care Center</option>
                            <option value="Document submitted by Government Organization, Non-Government Organization for Licensing/accreditation">Document submitted by Government Organization, Non-Government Organization for Licensing/accreditation</option>
                            <option value="List">List</option>
                            <option value="Closed NGOs">Closed NGOs</option>
                            <option value="Recipient of Core Shelter Assistance Project">Recipient of Core Shelter Assistance Project</option>
                            <option value="Release of Distribution of Relief/Donation">Release of Distribution of Relief/Donation</option>
                            <option value="Masterlists">Masterlists</option>
                            <option value="Accredited Day Care Center/Trainer">Accredited Day Care Center/Trainer</option>
                            <option value="Accredited Government Organization, (GO) and NGO's">Accredited Government Organization, (GO) and NGO's</option>
                            <option value="Accredited Local Government Unit (LGU)">Accredited Local Government Unit (LGU)</option>
                            <option value="Certificate of Travel Issued to Minor">Certificate of Travel Issued to Minor</option>
                            <option value="Client Served">Client Served</option>
                            <option value="Indigent Family in the Region">Indigent Family in the Region</option>
                            <option value="Non-Government Organization Marriage Counselor">Non-Government Organization Marriage Counselor</option>
                            <option value="Full Pledge Marriage Counselor">Full Pledge Marriage Counselor</option>
                            <option value="Pre-Marriage Counselor">Pre-Marriage Counselor</option>
                            <option value="Member of Self-Employment Assistance-Kaunlaran (SEA-K)">Member of Self-Employment Assistance-Kaunlaran (SEA-K)</option>
                            <option value="Parent's Effectiveness Service Volunteer">Parent's Effectiveness Service Volunteer</option>
                            <option value="Senior Citizen">Senior Citizen</option>
                            <option value="Social Worker Handling Court-Related Cases with Active Accreditation">Social Worker Handling Court-Related Cases with Active Accreditation</option>
                            <option value="Trained Trainee/Volunteer">Trained Trainee/Volunteer</option>
                            <option value="Victim of Calamities">Victim of Calamities</option>
                            <option value="Memoranda of Agreement (MOA)">Memoranda of Agreement (MOA)</option>
                            <option value="Modules/Syllabi of Training">Modules/Syllabi of Training</option>
                            <option value="News Letters">News Letters</option>
                            <option value="Plans">Plans</option>
                            <option value="Development Plan">Development Plan</option>
                            <option value="Community">Community</option>
                            <option value="Municipal">Municipal</option>
                            <option value="Provincial">Provincial</option>
                            <option value="Technical Assistance Resource Augmentation (TARA) Plan">Technical Assistance Resource Augmentation (TARA) Plan</option>
                            <option value="Procedures on Advocacy Materials">Procedures on Advocacy Materials</option>
                            <option value="Comprehensive & Integrated Delivery of Social Services (CIDSS)">Comprehensive & Integrated Delivery of Social Services (CIDSS)</option>
                            <option value="Program Material (Hand-outs, Poster)">Program Material (Hand-outs, Poster)</option>
                            <option value="Profiles">Profiles</option>
                            <option value="Barangay">Barangay</option>
                            <option value="Community">Community</option>
                            <option value="Municipal">Municipal</option>
                            <option value="NGOs with Complaints">NGOs with Complaints</option>
                            <option value="Provincial">Provincial</option>
                            <option value="Socio Economic Profile">Socio Economic Profile</option>
                            <option value="Programs/Projects Files">Programs/Projects Files</option>
                            <option value="Calendar of Activity">Calendar of Activity</option>
                            <option value="Guidelines">Guidelines</option>
                            <option value="Manual">Manual</option>
                            <option value="Plan">Plan</option>
                            <option value="Intervention">Intervention</option>
                            <option value="Investment">Investment</option>
                            <option value="Proposal">Proposal</option>
                            <option value="Budget">Budget</option>
                            <option value="In-house Training/Activity">In-house Training</option>
                            <option value="seminar">Seminar</option>
                            <option value="workshop">Workshop</option>
                            <option value="reports">Reports</option>
                            <option value="accomplishment">Accomplishment</option>
                            <option value="annual">Annual</option>
                            <option value="monthly_quarterly">Monthly/Quarterly</option>
                            <option value="absnet_report">Area Based Standard Network (ABSNET) Report</option>
                            <option value="assessment">Assessment</option>
                            <option value="claims_disaster_operation">Claims Disaster Operation Report</option>
                            <option value="cidss_implementation">Comprehensive & Integrated Delivery of Social Services (CIDSS) Implementation</option>
                            <option value="core_shelter_assistance">Core Shelter Assistance Project Inventory Report</option>
                            <option value="disadvantaged_transnational">Disadvantaged Transnational</option>
                            <option value="disaster_preparedness_plan">Disaster Preparedness Plan</option>
                            <option value="disaster_operation">Disaster Operation Report</option>
                            <option value="evaluation_monitoring">Evaluation/Monitoring</option>
                            <option value="home_study_report">Home Study Report (financial assistance)</option>
                            <option value="ngos_report">NGOs Report</option>
                            <option value="progress_status">Progress/Status (Program/Training)</option>
                            <option value="relief_donation_distribution">Release of Distribution of Relief/Donation</option>
                            <option value="self_employment_assistance">Self Employment Assistance-Kaunlaran Association (SKA)</option>
                            <option value="implementation_accomplishment">Implementation and Accomplishment</option>
                            <option value="social_case_study_report">Social Case Study Report (for financial assistance)</option>
                            <option value="social_development">Social Development</option>
                            <option value="client_served_status">Status of Client Served</option>
                            <option value="evacuee_standee_status">Status of Evacuee/Standee - Disaster Operation</option>
                            <option value="special_project_disadvantaged_transnational">Status of Special Project for Disadvantaged Transnational</option>
                            <option value="weight_record">Weight Record</option>
                            <option value="raw_data_surveys">Raw Data (Surveys)</option>
                            <option value="referrals">Referrals</option>
                            <option value="researches_case_studies">Researches/Case Studies (Output)</option>
                            <option value="solicitation_permits">Solicitation Permits</option>
                            <option value="statistical_reports_annual">Statistical Reports (Annual)</option>
                            <option value="statistical_reports_quarterly_monthly">Statistical Reports (Quarterly/Monthly)</option>
                            <option value="training_student_placement_files">Training of Student Placement Files</option>
                            <option value="training_proceedings">Training Proceedings</option>
                            <option value="weather_bulletin">Weather Bulletin</option>
                            @foreach ($socialOptions as $social)
                            @if ($social)
                                <option value="{{ $social }}">{{ $social }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="form-group my-1">
                        <label for="documentType">Select Time Value</label>
                        <select wire:model="doctype" class="form-control" id="documentType" required>
                            <option value="">Select Document Time Value</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Temporary">Temporary</option>
                            @foreach ($docOptions as $doc)
                            @if ($doc)
                                <option value="{{ $doc }}">{{ $doc }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>


                    {{-- Show due date input for temporary documents --}}
                    @if ($doctype == 'Temporary')
                        <div class="form-group my-1">
                            <label for="">Set Due Date</label>
                            <input type="date" wire:model='dueDate' class="form-control" required>
                        </div>
                    @endif

                    <div class="form-group my-1">
                        <label for="form-label d-block">Upload Document</label>
                        <input type="file" wire:model='document' class="form-control" accept=".pdf" required>
                        @error('document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end"> {{-- Add this container to align items to the end (right) --}}
                        <button type='submit' class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        @endif
    </div>
    <div>
        @if ($selectedDocument)
            <!-- Blurred background overlay -->
            <div class="modal-backdrop fade show" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1050;"></div>
            <!-- Modal or details section -->
            <div class="modal fade show slide-down" id="detailsModal" tabindex="-1" role="dialog" style="display: block; z-index: 1051;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content slide-in">
                        <div class="modal-header" style="background-color: #4e73df; color: #ffffff;">
                            <h5 class="modal-title">Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeDetails" style="color: #000; border: none; outline: none;">
                                <span aria-hidden="true" style="color: #ffffff;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Display document details here -->
                            <p><strong>Records Title:</strong> {{ $selectedDocument->document}}</p>
                            <p><strong>Reference Number:</strong> {{ $selectedDocument->reference_num }}</p>
                            <p><strong>Record Series:</strong> {{ $selectedDocument->filetype }}</p>
                            <p><strong>Records Located:</strong> {{ $selectedDocument->records_location }}</p>
                            <p><strong>File Description:</strong> {{ $selectedDocument->description }}</p>
                            <!-- Display document content -->
                            <iframe src="{{ route('get.document.content', ['documentId' => $selectedDocument->id]) }}" width="100%" height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document" style="max-width: 570px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000; border: none; outline: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display alerts from the session during testing -->
                    @if(session()->has('alerts') && count(session('alerts')) > 0)
                        @foreach(session('alerts') as $index => $alert)
                            <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
                                <p class="mb-0">{{ $alert }}</p>
                                <button type="button" class="close" wire:click="removeAlert({{ $index }})" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <p>No Notification found in the session.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
        @if ($showEditModal)
        <div x-data="{ open: true }">
            <div x-show="open" x-cloak>
                <div class="modal fade show" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" style="display: block;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #4e73df; color: #ffffff;">
                                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="cancelEditReferenceNumber" style="color: #ffffff; border: none; outline: none;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="updateReferenceNumber">
                                    <div class="form-group my-1">
                                        <label for="records_location">Select Location Records</label>
                                        <select wire:model='records_location' class="form-control" id="records_location" required>
                                            <option value="">Select Location</option>
                                            <option value="DSWD Field Office XI">DSWD Field Office XI</option>
                                            
                                            @foreach ($locationOptions as $location)
                                            @if ($location)
                                                <option value="{{ $location }}">{{ $location }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="description" class="mb-1">Description</label>
                                        <textarea rows="4" wire:model='description' class="form-control" id="description" required></textarea>
                                    </div>
                                    <button type='submit' class="btn btn-primary">Save Changes</button>
                                    <button type='button' wire:click="cancelEditReferenceNumber" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
            </div>
        </div>
    @endif
</div>
