@extends('Master.Master')

@section('main')
    <div class="chart-container">
        <canvas id="myChart" height="100"></canvas>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.4.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            var labels = {{ Js::from($labels) }};
            var amountIdea = {{ Js::from($data) }};

            const data = {
                labels: labels,
                datasets: [{
                    label: "Amount",
                    backgroundColor: 'rgb(255,160,122)',
                    borderColor: 'rgb(255,0,0)',
                    borderWidth: 2,
                    borderSkipped: false,
                    data: amountIdea,
                }, ]
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
                            text: 'Number of ideas per department/year',
                        }
                    }
                },
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config);
        </script>
    </div>
    <div>
        <p>Thông kê</p>
        <form autocomplete="off">
            @csrf
            <div class="col-md-2">
                <p>Từ ngày <input type="datetime-local" id="datepicker" class="form-control"></p>
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
            </div>
            <div class="col-md-2">
                <p>Đến ngày <input type="datetime-local" id="datepicker" class="form-control"></p>

            </div>
        </form>
    </div>
@endsection
