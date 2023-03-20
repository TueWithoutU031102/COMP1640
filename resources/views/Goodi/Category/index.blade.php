@extends('Goodi.nav_bar')

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
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <br>
    <section class="profile-content">
        <div class="profile-container">
            <div class="cate_list">
                <div class="imp-link">
                    <a type="button" href="/category/create" class="btn btn-success"
                        style="font-weight: bold; font-size: 20px; text-align:center; color: #white;">Create New
                        Category</a>
                    <div class="category">
                        <p>Category</p>
                        @foreach ($categories as $category)
                            <div class="cate_box">
                                <a href="/category/show/{{ $category->id }}" title="View Category">
                                    <i aria-hidden="true">{{ $category->title }}
                                </a>
                                <a href="/category/edit/{{ $category->id }}" title="Edit Account"><button
                                        class="btn btn-primary btn-sm"><i aria-hidden="true"><i
                                                class="fa-solid fa-pen"></i></button>
                                </a>
                                <form action="/category/delete/{{ $category->id }}" method="POST" class="d-inline"
                                    style="margin-right: 10px"
                                    onsubmit="return confirm('Are you sure to delete {{ $category->title }} !!!???')">
                                    @csrf
                                    <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                                class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="dashboard">
                <div class="post-container">
                    <canvas id="myChart" height="100"></canvas>
                    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.4.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script type="text/javascript">
                        var labels = {{ Js::from($labels) }};
                        var amountIdea = {{ Js::from($data) }};

                        const data = {
                            labels: labels,
                            datasets: [{
                                label: "Total",
                                backgroundColor: 'rgb(255,160,122)',
                                borderColor: 'rgb(255,0,0)',
                                borderWidth: 2,
                                borderSkipped: false,
                                data: amountIdea,
                            }, ]
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

                        const myChart = new Chart(
                            document.getElementById('myChart'),
                            config);
                    </script>
                </div>
                <div class="post-container">

                </div>
            </div>
        </div>
        </div>
    </section>
    @include('Goodi.footer')
@endsection
