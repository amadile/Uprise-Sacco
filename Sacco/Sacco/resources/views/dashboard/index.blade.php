<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <!-- --------HEADING------------------ -->
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h3 class="text-white text-center">
                                    UPRISE SACCO
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------ -->

             <!-- ===========================CHARTS====================================== -->
            
             <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Website Views</h6>
                            <p class="text-sm ">Last Campaign Performance</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Daily Sales </h6>
                            <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today
                                sales. </p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm"> updated 4 min ago </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Completed Tasks</h6>
                            <p class="text-sm ">Last Campaign Performance</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">just updated</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!---------------end of graphs---------------------------------- -->


            <!-- ---------------LOAN REQUEST TABLES-------------- -->

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h3 class="text-white text-center">LOAN REQUESTS</h3>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <!-- Check if there are records to display -->
                            @if (count($lines) > 0 && $lines->contains('loan_approval_status', null))
                            <form action="{{ route('update_loan_approval') }}" method="POST">
                                @csrf
                                <div class="table-responsive p-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>M.I.D</th>
                                                <th style="word-break: break-all;">L.A.N</th>
                                                <th>LOAN AMOUNT</th>
                                                <th style="word-break: break-all;">MONTHS</th>
                                                <th style="word-break: break-all;">RECOMMENDED FUNDS</th>
                                                <th>REQUEST TIME</th>
                                                <th>URGENCY</th>
                                                <th style="word-break: break-all;"> STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lines as $line)

                                            <tr>
                                                <td>{{ $line->member_id }}</td>
                                                <td>{{ $line->loan_application_number }}</td>
                                                <td>{{ $line->loan_amount }}</td>
                                                <td>{{ $line->payment_period }}</td>
                                                <td>{{ $line->recommended_funds }}</td>
                                                <td>{{ $line->created_at }}</td>
                                                <td>
                                                    @php
                                                    // Calculate the time that is 5 hours ahead of created_at
                                                    $createdAtTime = $line->created_at;
                                                    $timeAhead = $createdAtTime->addHours(5);

                                                    // Compare with the current time
                                                    //this next line is for date correction so if you have a working time variable it may not be needed
                                                    date_default_timezone_set('America/Los_Angeles');
                                                    $currentTime = now();

                                                    $isTimeAhead = $currentTime->greaterThan($timeAhead);
                                                    @endphp

                                                    @if ($isTimeAhead)
                                                    <span style="color: red;">&#9733;</span> <!-- Red star dot -->
                                                    @else
                                                    <span>&#9733;</span> <!-- Default star -->
                                                    @endif
                                                </td>
                                                <td>
                                                    <select name="loan_approval_status[{{ $line->loan_application_number }}]" id="loan_approval_status_{{ $line->loan_application_number }}" class="form-select">
                                                        <option value="">Not yet approved</option>
                                                        <option value="granted" @if($line->loan_approval_status === 'granted') selected @endif>Granted
                                                        </option>
                                                        <option value="rejected" @if($line->loan_approval_status === 'rejected') selected @endif>Rejected
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            @else
                            <p style="text-align: center; font-weight: bold;">No Loan Approval Requests as of yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            <!-- ------------------------END OF LOAN REQUESTS TABLE--------------------------- -->





            <!-- ---------------------------------FAILED LOGIN TABLE--------------------------- -->
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h3 class="text-white text-center">FAILED LOGINS</h3>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if (count($records) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>MEMBER_ID</th>
                                            <th>USERNAME</th>
                                            <th>PASSWORD</th>
                                            <th>PHONE_NUMBER</th>
                                            <th>ERROR_TIME</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                        <tr>
                                            <td>{{ $record->member_id }}</td>
                                            <td>{{ $record->username }}</td>
                                            <td>{{ $record->password }}</td>
                                            <td>{{ $record->phone_number }}</td>
                                            <td>{{ $record->created_at }}</td>
                                            <td>
                                                @php
                                                $createdAtTime = $record->created_at;
                                                $timeAhead = $createdAtTime->addHours(5);
                                                date_default_timezone_set('America/Los_Angeles');
                                                $currentTime = now();
                                                $isTimeAhead = $currentTime->greaterThan($timeAhead);
                                                @endphp

                                                @if ($isTimeAhead)
                                                <span class="text-danger">&#9733;</span>
                                                @else
                                                <span>&#9733;</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-center font-weight-bold mt-4">No failed logins as of yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- --------------------------------------------------- -->

            <!-- ---------------FAILED DEPOSITS TABLES-------------- -->
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h3 class="text-white text-center mb-0">FAILED DEPOSITS</h3>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                @if (count($rows) > 0)
                                <table class="table table-bordered table-striped table-hover align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>MEMBER_ID</th>
                                            <th>RECEIPT NUMBER</th>
                                            <th>AMOUNT</th>
                                            <th>DATE</th>
                                            <th>ERROR_TIME</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $row)
                                        <tr>
                                            <td>{{ $row->member_id }}</td>
                                            <td>{{ $row->receipt_number }}</td>
                                            <td>{{ $row->amount }}</td>
                                            <td>{{ $row->date }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                @php
                                                // Calculate the time that is 5 hours ahead of created_at
                                                $createdAtTime = $row->created_at;
                                                $timeAhead = $createdAtTime->addHours(5);

                                                // Compare with the current time
                                                //this next line is for date correction so if you have a working time variable it may not be needed
                                                date_default_timezone_set('America/Los_Angeles');
                                                $currentTime = now();

                                                $isTimeAhead = $currentTime->greaterThan($timeAhead);
                                                @endphp

                                                @if ($isTimeAhead)
                                                <span style="color: red;">&#9733;</span> <!-- Red star dot -->
                                                @else
                                                <span>&#9733;</span> <!-- Default star -->
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p class="text-center font-weight-bold">No failed Deposits as of yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ------------------------END OF FAILED_DEPOSITS TABLE--------------------------- -->





</x-layout>