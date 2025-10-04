<style>
  @media print {

    body,
    html {
      background: #fff !important;
      color: #222;
      font-size: 13px;
    }

    .content-wrapper,
    .container-fluid,
    .card.view_sell_page_info {
      box-shadow: none !important;
      background: #fff !important;
      margin: 0 !important;
      padding: 0 !important;
    }

    .view_sell_button-area,
    .sidebar,
    .main-sidebar,
    .main-header,
    .main-footer,
    .navbar,
    .view_sell_payment_info {
      display: none !important;
    }

    .pos-invoice {
      margin: 0 auto !important;
      width: 100% !important;
      max-width: 420px !important;
      border: none !important;
      box-shadow: none !important;
    }

    .pos-invoice th,
    .pos-invoice td {
      font-size: 12px !important;
      padding: 4px 6px !important;
    }

    .barcode-area {
      margin-top: 10px;
      text-align: center;
    }
  }

  .pos-invoice {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    max-width: 420px;
    margin: 30px auto;
    padding: 18px 18px 8px 18px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
    font-family: 'Segoe UI', Arial, sans-serif;
  }

  .pos-invoice h2 {
    font-size: 22px;
    margin: 0 0 4px 0;
    font-weight: 700;
    letter-spacing: 1px;
    color: #013173;
    text-align: center;
  }

  .pos-invoice .shop-info {
    text-align: center;
    margin-bottom: 8px;
  }

  .pos-invoice .invoice-meta,
  .pos-invoice .customer-info {
    font-size: 13px;
    margin-bottom: 6px;
    text-align: left;
  }

  .pos-invoice .customer-info {
    margin-bottom: 10px;
    border-bottom: 1px dashed #ccc;
    padding-bottom: 6px;
  }

  .pos-invoice table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 8px;
  }

  .pos-invoice th,
  .pos-invoice td {
    border: none;
    padding: 5px 6px;
    font-size: 13px;
    text-align: left;
  }

  .pos-invoice th {
    background: #f5f5f5;
    font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #eee;
  }

  .pos-invoice .totals-table td {
    font-weight: 600;
    text-align: right;
    border: none;
    padding: 3px 0;
  }

  .pos-invoice .totals-table tr:last-child td {
    border-top: 1px solid #eee;
    font-size: 15px;
    color: #013173;
  }

  .barcode-area {
    margin-top: 10px;
    text-align: center;
  }

  .barcode-img {
    width: 180px;
    height: 40px;
    margin: 0 auto;
    display: block;
  }

  .pos-invoice .inwords {
    font-size: 12px;
    color: #444;
    margin-top: 8px;
    text-align: left;
    font-style: italic;
  }
</style>
<!-- Content Wrapper. Contains page content  -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content mt-5">
    <div class="container-fluid">
      <div class="card view_sell_page_info">
        <div class="card-body">
          <?php
          if (isset($_GET['view_id'])) {
            $view_id = $_GET['view_id'];
            $sell_total = $obj->find('invoice', 'id', $view_id);
            $customer = $sell_total->customer_id;
            $customer = $obj->find('member', 'id', $customer);
            if ($sell_total) {
          ?>
              <div class="pos-invoice">
                <div class="shop-info">
                  <h2>Nexo Pos</h2>
                  <div style="font-size:13px; color:#444;">Ample Billing and Inventory Software</div>
                  <div style="font-size:12px; color:#888;">www.yourshopdomain.com</div>
                </div>
                <div class="invoice-meta">
                  <span><b>Invoice:</b> <?= $sell_total->invoice_number; ?></span><br>
                  <span><b>Date:</b> <?= $sell_total->order_date; ?></span>
                </div>
                <div class="customer-info">
                  <b>Customer:</b> <?= $customer->name; ?><br>
                  <span><?= $customer->company; ?></span><br>
                  <span><?= $customer->address; ?></span><br>
                  <span><?= $customer->con_num; ?></span>
                </div>
                <table>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Qty</th>
                      <th>Unit</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $invoice_id = $sell_total->id;
                    $all_product = $obj->findWhere('invoice_details', 'invoice_no', $invoice_id);
                    $i = 0;
                    foreach ($all_product as $products) {
                      $i++;
                      $pid = $products->pid;
                      $p_brand = $obj->find('products', 'id', $pid);
                    ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $products->product_name ?></td>
                        <td><?= $products->quantity ?></td>
                        <td><?= $products->price / $products->quantity ?></td>
                        <td><?= $products->price ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <table class="totals-table">
                  <tr>
                    <td>Subtotal</td>
                    <td><?= $sell_total->sub_total; ?></td>
                  </tr>
                  <tr>
                    <td>Previous Due</td>
                    <td><?= $sell_total->pre_cus_due; ?></td>
                  </tr>
                  <tr>
                    <td>Net Total</td>
                    <td><?= $sell_total->net_total; ?></td>
                  </tr>
                  <tr>
                    <td>Paid</td>
                    <td><?= $sell_total->paid_amount; ?></td>
                  </tr>
                  <tr>
                    <td>Due</td>
                    <td><?= $sell_total->due_amount; ?></td>
                  </tr>
                </table>
                <div class="inwords">
                  <b>In Words:</b> <?= $sell_total->net_total; ?> Taka Only
                </div>
                <table>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Payment Method</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $all_payment = $obj->findWhere('sell_payment', 'invoice_number', $sell_total->invoice_number);
                    $i = 0;
                    foreach ($all_payment as $payment) {
                      if (strpos($payment->invoice_number, 'GENERAL') !== false) continue;
                      $i++;
                    ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $payment->payment_type; ?></td>
                        <td><?= $payment->payment_amount; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="barcode-area">
                  <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= $sell_total->invoice_number; ?>&code=Code128&translate-esc=true" class="barcode-img" alt="Barcode" />
                </div>
                <div style="text-align:center; margin-top:10px; font-size:12px; color:#888;">Thank you for your purchase!</div>
              </div>
              <div class="view_sell_button-area" style="text-align:center; margin-top:20px;">
                <button type="button" onclick="window.print()" class="btn btn-primary ml-2"><i class="fas fa-file-pdf"></i> Print</button>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.row -->
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper