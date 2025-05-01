<div class="main-sidebar">
   <div class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
         <li>
            <a href="{{route('products.index')}}">
               <i class="fa fa-star-o"></i> <span>Produk</span>
            </a>
         </li>
         <li>
            <a href="{{route('customers.index')}}">
               <i class="fa fa-star-o"></i> <span>Customer</span>
            </a>
         </li>
         <li>
            <a href="{{route('purchase_invoices.index')}}">
               <i class="fa fa-star-o"></i> <span>Pembelian</span>
            </a>
         </li>
         <li>
            <a href="{{route('sales_invoices.index')}}">
               <i class="fa fa-star-o"></i> <span>Penjualan</span>
            </a>
         </li>
         <li class="treeview">
            <a href="#">
               <i class="fa fa-star-o"></i> <span>Laporan</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{route('laporan_stok_barang.index')}}"><i class="fa fa-circle-o"></i> Stok</a></li>
            </ul>
         </li>
      </ul>
   </div>
</div>
