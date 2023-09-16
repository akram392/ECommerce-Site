<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('frontend/invoice/images/favicon.png') }}" rel="icon" />

    <title>ECommerce Invoice</title>

    <!-- Web Fonts
    ======================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

    <!-- Stylesheet
    ======================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/invoice/vendor/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/invoice/css/stylesheet.css') }}"/>
  </head>


  <body>
    <!-- Container -->
    <div class="container-fluid invoice-container" id="tblstudents">
      <!-- Header -->
      <header>
        <div class="row align-items-center">
          <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
            <img id="logo" src="{{ asset('frontend/invoice/images/logo.png') }}" title="Koice" alt="Koice" />
          </div>
          <div class="col-sm-5 text-center text-sm-end">
            <h4 class="text-7 mb-0">Invoice</h4>
          </div>
        </div>
        <hr>
      </header>

      <!-- Main Content -->
      <main>
        <div class="row">
            <div class="col-sm-6"><strong>Date: </strong>{{ $order_details->order_date }}</div>
            <div class="col-sm-6 text-sm-end"> <strong>Invoice No: </strong>{{ $order_details->id }}</div>
        </div>
        <hr>

        <div class="row">
          <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
            <address>
            Koice Inc<br />
            2705 N. Enterprise St<br />
            Orange, CA 92865<br />
      	    contact@koiceinc.com
            </address>
          </div>

          <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
            <address>
                {{ $order_details->id }} <br/>
                {{ $order_details->email }} <br/>
                {{ $order_details->address_line1 }}, {{ $order_details->address_line2 }} <br/>
                {{ $district->name }},
                {{ $division->name }},
                {{ $order_details->zipCode }} <br/>
                {{ $order_details->country_name }} <br/>
                {{ $order_details->phone }} <br/>
            </address>
          </div>
        </div>

        <div class="card">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table mb-0">
      		      <thead class="card-header">
                  <tr>
                    <td class="col-6"><strong>Product Name</strong></td>
                    <td class="col-2 text-center"><strong>Rate</strong></td>
        			<td class="col-1 text-center"><strong>QTY</strong></td>
                    <td class="col-3 text-end"><strong>Amount</strong></td>
                  </tr>
                </thead>

                <tbody>
                    @foreach ( App\Models\Cart::where('order_id', $order_details->id)->get() as $orderDetails )
                        <tr>
                            <td class="col-6">{{ $orderDetails->product->title }}</td>
                            <td class="col-2 text-center">
                                @if ( !is_null( $orderDetails->product->offer_price ) )
                                    {{ $orderDetails->product->offer_price }} BDT
                                @else
                                {{ $orderDetails->product->regular_price }} BDT
                                @endif
                            </td>
                            <td class="col-1 text-center">{{ $orderDetails->quantity }} Pcs</td>
                            <td class="col-3 text-end">
                                @if ( !is_null( $orderDetails->product->offer_price ) )
                                    {{ $orderDetails->quantity * $orderDetails->product->offer_price }} BDT
                                @else
                                    {{ $orderDetails->quantity * $orderDetails->product->regular_price }} BDT
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>

                <tfoot class="card-footer">
                    <tr>
                        <td colspan="3" class="text-end"><strong>Sub Total:</strong></td>
                        <td class="text-end">{{ $order_details->total_amount }} BDT</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-end"><strong>Tax:</strong></td>
                        <td class="text-end">0.00</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-end border-bottom-0"><strong>Total:</strong></td>
                        <td class="text-end border-bottom-0">{{ $order_details->total_amount }} BDT</td>
                    </tr>
      		      </tfoot>

              </table>
            </div>
          </div>
        </div>
      </main>

      <!-- Footer -->
      <footer class="text-center mt-4">
        <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>

        <div class="btn-group btn-group-sm d-print-none">
          <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
          <button type="button" id="btnExport" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</button>
        </div>
        <div class="mt-2 text-center">
            <a href="{{ route('homepage') }}">Back to Homepage</a>
        </div>
      </footer>
    </div>

    {{-- <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('homepage') }}">Back to Homepage</a>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <!-- PDF File Generate -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script type="text/javascript">
      $("body").on("click", "#btnExport", function () {
          html2canvas($('#tblstudents')[0], {
              onrendered: function (canvas) {
                  var data = canvas.toDataURL();
                  var docDefinition = {
                      content: [{
                          image: data,
                          width: 500
                      }]
                  };
                  pdfMake.createPdf(docDefinition).download("e-book.pdf");
              }
          });
      });
    </script>

  </body>
</html>
