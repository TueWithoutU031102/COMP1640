@extends('Master.Master')

@section('main')
    <section class="banner">
        @include('Goodi.nav_bar')
        <div class="text-box">
            <h1>
                <p>IDEA <span class="text-highlight">CATEGORIES</span></p>
            </h1>
            <p>
                Goodi Category, Place to sort idea into a group
            </p>
            <br>
        </div>
    </section>
    <div>
        <h6>phần trăm số idea của từng department trên tổng số</h6>
        <h1>IT</h1>
        <h2>{{ $percentITIdea }}%</h2>
        <h1>Bussiness</h1>
        <h2>{{ $percentBussinessIdea }}%</h2>
    </div>
    <div>
        <h6>trên tổng số các idea, thì idea nào không hay (dislike >like) và idea nào hay (like>dislike)</h6>
        <h1>Tổng bài đã đăng</h1>
        <h2>
            {{ $totalIdea }}
        </h2>
        <h1>Hay (Like > Dislike)</h1>
        <h2>
            {{ $percentGoodIdea }}%
        </h2>
        <h1>Không hay (Dislike > Like)</h1>
        <h2>
            {{ $percentBadIdea }}%
        </h2>
    </div>
    <div class="dashboard">
        <div class="post-container">
            <canvas id="Chart1" height="100"></canvas>
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.4.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script type="text/javascript">
                var labels = {{ Js::from($labels) }};
                var amountIdea = {{ Js::from($data) }};
                var amountIdeaIT = {{ Js::from($dataIT) }};
                var amountIdeaBusiness = {{ Js::from($dataBusiness) }};

                const data = {
                    labels: labels,
                    datasets: [{
                            label: "Total",
                            backgroundColor: 'rgb(255,160,122)',
                            borderColor: 'rgb(255,0,0)',
                            data: amountIdea,
                        },
                        {
                            label: "IT",
                            backgroundColor: 'rgb(222,122,122)',
                            borderColor: 'rgb(222,0,0)',
                            data: amountIdeaIT,
                        },
                        {
                            label: "Business",
                            backgroundColor: 'rgb(100,100,100)',
                            borderColor: 'rgb(100,0,0)',
                            data: amountIdeaBusiness,
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
        <div class="post-container">
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
                    const data = {
                        labels: ' ',
                        datasets: [{
                                label: 'IT',
                                data: dataCountIT,
                                backgroundColor: 'rgb(100,100,100)',
                            },
                            {
                                label: 'Business',
                                data: dataCountBusiness,
                                backgroundColor: 'rgb(255,160,255)',
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
