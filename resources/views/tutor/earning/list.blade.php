@extends('layouts.tutor')
@section('title', 'Earnings')
@section('content')

    <div class="card ">

        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center  ">
                <h2 class="text-center has-line text-dark line-primary">Earnings</h2>
            </div>
            <div class="col-lg-12 p-3">
                <table class="table w-100 display" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>Reciept</th>
                        <th>Balance</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>${{$item->amount}}</td>
                            <td>
                                <a class="btn btn-primary btn_primary" href="{{ route('tutor.earning.download.reciept',['id'=>$item->id]) }}">
                                    Download
                                </a>
                            </td>
                            <td>${{$item->balance ?? ''}}</td>
                            <td>{{$item->note ?? ''}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade rounded" id="approveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Are you want to approve ?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <a href="" class="btn btn-primary w-100 rounded-sm approve_link" type="submit">Yes</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Approve Modal -->

    <!-- Cancel Modal -->
    <div class="modal fade rounded" id="cancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Are you want to cancel request ?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <a href="" class="btn btn-primary w-100 rounded-sm cancel_link" type="submit">Yes </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cancel Modal -->
@endsection
@section('js')
    <script>
        // Approve Modal Jquery
        $(document).on("click",".approve_button",function(){
            var approve_link=$(this).attr('data-href');
            $(".approve_link").attr("href",approve_link);
            $("#approveModal").modal('show');
        });

        // Cancel Modal Jquery
        $(document).on("click",".cancel_button",function(){
            var cancel_link=$(this).attr('data-href');
            $(".cancel_link").attr("href",cancel_link);
            $("#cancelModal").modal('show');
        });
    </script>

@endsection
