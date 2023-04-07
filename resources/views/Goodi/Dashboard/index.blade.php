@extends('Master.Master')

@section('main')
    <section class="banner">
        @include('Goodi.nav_bar')
        <div class="text-box">
            <h1>
                <p>GOODI <span class="text-highlight">DASHBOARD</span></p>
            </h1>
            <p>
                Goodi Dashboard, Place to Analayze Data From the Website
            </p>
            <br>
        </div>
    </section><br>
    <div class="dashboard">
        <div class="dashboard-box" style="background: #ff9900; border-left: solid 10px #000000;">
            <h4>Department <i class="fa-solid fa-building"></i></h4>
            <div class="dashboard-content">
                <div>
                    <p>IT</p>
                    <span>{{ $percentITIdea }}%</span>
                </div>
                <div>
                    <p>Bussiness</p>
                    <span>{{ $percentBussinessIdea }}%</span>
                </div>
                <div>
                    <p>Graphic Design</p>
                    <span>{{ $percentDesignIdea }}%</span>
                </div>
            </div>
        </div>
        <div class="dashboard-box" style="border-left: solid 10px #00c8e2;">
            <h4>Total of Idea <i class="fa-solid fa-lightbulb"></i></h4>
            <p>
                {{ $totalIdea }}
            </p>
        </div>
        <div class="dashboard-box" style="border-left: solid 10px #ef113d;">
            <h4>Percent of GOOD Idea <i class="fa-solid fa-heart"></i></h4>
            <p>
                {{ $percentGoodIdea }}%
            </p>
        </div>
        <div class="dashboard-box" style="border-left: solid 10px #57c14b;">
            <h4>Percent of BAD Idea <i class="fa-solid fa-heart-crack"></i></h4>
            <p>
                {{ $percentBadIdea }}%
            </p>
        </div>
    </div><br><br>
    <div class="chart">
        <div class="dashboard-box">
            <canvas id="Chart1" height="100"></canvas>
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.4.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script type="text/javascript">
                var labels = {{ Js::from($labels) }};
                var amountIdea = {{ Js::from($data) }};
                var amountIdeaIT = {{ Js::from($dataIT) }};
                var amountIdeaBusiness = {{ Js::from($dataBusiness) }};
                var amountIdeaDesign = {{ Js::from($dataDesign) }};

                const data = {
                    labels: labels,
                    datasets: [{
                            label: "Total",
                            backgroundColor: 'rgba(245, 141, 21, 0.432)',
                            borderColor: 'rgba(245, 103, 21, 0.432)',
                            data: amountIdea,
                        },
                        {
                            label: "IT",
                            backgroundColor: 'rgba(21, 178, 245, 0.432)',
                            borderColor: 'rgba(21, 70, 245, 0.432)',
                            data: amountIdeaIT,
                        },
                        {
                            label: "Business",
                            backgroundColor: 'rgba(51, 196, 121, 0.432)',
                            borderColor: 'rgba(2, 91, 45, 0.432)',
                            data: amountIdeaBusiness,
                        },
                        {
                            label: "Graphic Design",
                            backgroundColor: 'rgba(1, 1, 1, 1)',
                            borderColor: 'rgba(2, 2, 2, 2)',
                            data: amountIdeaDesign,
                        },

                    ]
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Number of ideas per department/year',
                            }
                        }
                    },
                };
                const Chart1 = new Chart(
                    document.getElementById('Chart1'),
                    config);
            </script>
        </div>
        <div class="dashboard-box">
            <canvas id="Chart2" height="100"></canvas>
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.4.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script type="text/javascript">
                (() => {
                    //(()=>{})()
                    //
                    //() đầu tiền là tham số suy ra {} : định nghĩa 1 hàm
                    //bên trong {} là code thực thi của hàm
                    //ngoặc tròn bao quanh 2 ngoặc đầu là định nghĩa hàm không tên
                    //ngoặc cuối là thực thi nội dung bên trong
                    let dataCountBusiness = {{ Js::from($dataCountBusiness) }};
                    let dataCountIT = {{ Js::from($dataCountIT) }};
                    let dataCountDesign = {{ Js::from($dataCountDesign) }};
                    const data = {
                        labels: ' ',
                        datasets: [{
                                label: 'IT',
                                data: dataCountIT,
                                backgroundColor: 'rgba(21, 178, 245, 0.432)',
                                borderColor: 'rgba(21, 70, 245, 0.432)',
                            },
                            {
                                label: 'Business',
                                data: dataCountBusiness,
                                backgroundColor: 'rgba(51, 196, 121, 0.432)',
                                borderColor: 'rgba(2, 91, 45, 0.432)',
                            },
                            {
                                label: 'Graphic Design',
                                data: dataCountDesign,
                                backgroundColor: 'rgba(1, 1, 1, 1)',
                                borderColor: 'rgba(2, 2, 2, 2)',
                            }
                        ]
                    };
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Numbers of contributors (staffs with idea submission) per departments'
                                }
                            }
                        },
                    };
                    const Chart2 = new Chart(
                        document.getElementById('Chart2'),
                        config);
                })()
            </script>
        </div>
    </div>
    @include('Goodi.footer')
@endsection
