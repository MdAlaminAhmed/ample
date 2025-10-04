<?php
require_once '../init.php';
if (isset($_POST['getOrderItem'])) {
?>
  <tr>
    <td><b class="si_number">1</b></td>
    <td>
      <div class="product-search-container position-relative">
        <input type="text" class="form-control form-control-sm product-search" placeholder="Search product by name, barcode, or SKU..." autocomplete="off">
        <input type="hidden" class="pid" name="pid[]" value="">
        <div class="product-search-results" style="display: none; position: absolute; z-index: 1000; background: white; border: 1px solid #ddd; max-height: 300px; overflow-y: auto; width: 100%;"></div>
      </div>
    </td>
    <td><input type="text" class="form-control form-control-sm qaty" placeholder="Total Quantity" name="total_quantity[]" id="totalQuantity" readonly></td>
    <td><input type="number" class="form-control form-control-sm price" placeholder="Price" name="price[]" id="price"></td>
    <td><input type="number" class="form-control form-control-sm oqty" placeholder="Order Quantity" name="orderQuantity[]"></td>
    <td><input type="number" class="form-control form-control-sm tprice" placeholder="Total Price" name="totalPrice[]" id="totalPrice" readonly></td>
    <td><input type="text" readonly class="form-control form-control-sm pro_name" name="pro_name[]" id="pro_name"></td>
    <td><button type="button" class="btn btn-danger btn-sm pl-3 pr-3 cancelThisItem" id="cancelThisItem"><i class="fas fa-times"></i></button></td>
  </tr>
<?php
}

?>