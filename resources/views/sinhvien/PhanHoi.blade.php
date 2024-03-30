@extends('sinhvien.layout.master')

@section('title', 'Phản hồi')

@section('body')
    <style>
        /*container*/
        .container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-bottom: 50px;
        }

        .title {
            margin-top: 50px;
            color: #C31313;
        }

        .form-update {
            margin-top: 30px;
            height: 270px;
            width: 350px;
            background: #21C3E0;
            border: 1px solid black;
            border-radius: 5px;
            display: inline-block;
        }

        .text-textarea textarea {
            padding: 5px;
            float: right;
            margin-right: 20px;
            width: 200px;
            height: 130px;
            margin-top: 20px;
        }

        .text-textarea label {
            float: left;
            margin-top: 20px;
            margin-left: 20px;
            font-weight: bold;
        }

        form button {
            padding: 10px;
            background: #FFBD00;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin: 30px;
        }

        form button a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        footer {
            position: fixed;
            bottom: 0;
        }
    </style>

    <!--main-->
    <div class="container">
        <div class="title">
            <h1>PHẢN HỒI</h1>
        </div>
        <div class="form-update">
            <form method="post" action="{{ url('/add') }}">
                @csrf
                <div class="text-textarea">
                    <label>Nội dung</label>
                    <textarea required name="NoiDung"></textarea>
                </div>
                <button type="submit">
                    <a>Xác nhận</a>
                </button>
            </form>
        </div>
    </div>
@endsection
