@extends('../layout.layout')

@section('title', 'Reports')

@section('content')

<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
        <h2>Inventory Reports</h2>
        <hr>
        <div class="row">
            <div class="col-md-4 text-center margin-top-20">
                <a href="/load-date-stock" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Stock Reports by Dates</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center margin-top-20">
                <a href="/load-daily-stock" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Daily Stock Reports</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 text-center margin-top-20">
                <a href="/load-state-wise" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Estate wise Reports</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 text-center margin-top-40">
                <a href="/load-division-wise" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Division wise Reports</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center margin-top-40">
                <a href="/load-user-wise" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>User wise Reports</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center margin-top-40">
                <a href="/load-category-wise" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Category wise Reports</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center margin-top-40">
                <a href="/load-product-wise" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Product wise Reports</h4>
                    </div>
                </a>
            </div>

            <div class="col-md-4 text-center margin-top-40">
                <a href="/load-date-income" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Income Reports</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center margin-top-40">
                <a href="/load-date-expend" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Expenditure Reports</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center margin-top-40">
                <a href="/low-stock-product" class="btn btn-block report-btn">
                    <div class="col-md-12">
                        <h4>Low Stock Product Reports</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
