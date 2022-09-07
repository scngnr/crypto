<div>


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" >
      <!--begin::Container-->
      <div class="container-xxl" id="kt_content_container">
        <!--begin::Category-->
        <div class="card card-flush">
          <!--begin::Card header-->
          <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">
              <div class="col">
                <h1 class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0"> Açık işlemler ({{count($openOrders)}})</h1>
              </div>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
              (!)
            </div>
            <!--end::Card toolbar-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5">
              <!--begin::Table head-->
              <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                  <th class="min-w-70px">İşlem Çifti </th>
                  <th class="min-w-70px">İşlem</th>
                  <th class="  min-w-70px">Alış Fiyatı</th>
                  <th class="  min-w-70px">Alış tarihi</th>
                </tr>
                <!--end::Table row-->
              </thead>
              <!--end::Table head-->
              <!--begin::Table body-->
              <tbody class="fw-bold text-gray-600">
                <!--begin::Table row-->

              @foreach($openOrders as $op)
                <tr>

                  <td><div class="badge badge-light-success"></div> {{$op->symbol}}  </td>
                  <!--end::Checkbox-->
                  <!--begin::Type=-->
                  <td><div class="badge badge-light-success"></div> {{$op->status }}  </td>
                  <!--end::Type=-->
                  <!--begin::Type=-->
                  <td><div class="badge badge-light-success"></div> {{$op->price}}  </td>
                  <!--end::Type=-->
                  <!--begin::Category=-->
                  <td><div class="badge badge-light-success"></div> {{$op->created_at}}  </td>
                  <!--end::Category=-->
                </tr>
                @endforeach
                <!--end::Table row-->
              </tbody>
              <!--end::Table body-->
            </table>
            <!--end::Table-->
          </div>
          <!--end::Card body-->
        </div>
        <!--end::Category-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::Content-->
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content" >
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
      <!--begin::Category-->
      <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <!--begin::Card title-->
          <div class="card-title">
            <div class="col">
              <h1 class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0"> Tamamlanmış işlemler ({{count($closedOrders)}})</h1>
            </div>
          </div>
          <!--end::Card title-->
          <!--begin::Card toolbar-->
          <div class="card-toolbar">
            (!)
          </div>
          <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
          <!--begin::Table-->
          <table class="table align-middle table-row-dashed fs-6 gy-5">
            <!--begin::Table head-->
            <thead>
              <!--begin::Table row-->
              <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th class="min-w-70px">İşlem Çifti </th>
                <th class="min-w-70px">İşlem</th>
                <th class="  min-w-70px">Alış Fiyatı</th>
                <th class="  min-w-70px">Satış Fiyatı</th>
                <th class="  min-w-70px">işlem Yüzdesi</th>
                <th class="  min-w-70px">Alış tarihi</th>
                <th class="  min-w-70px">Satış tarihi</th>
              </tr>
              <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-bold text-gray-600">
              <!--begin::Table row-->

              @foreach($closedOrders as $op)
                <tr>

                  <td><div class="badge badge-light-success"></div> {{$op->symbol}}  </td>
                  <!--end::Checkbox-->
                  <!--begin::Type=-->
                  <td><div class="badge badge-light-success"></div> {{$op->status }}  </td>
                  <!--end::Type=-->
                  <!--begin::Type=-->
                  <td><div class="badge badge-light-success"></div> {{$op->price}}  </td>
                  <!--end::Type=-->
                  <!--begin::Type=-->
                  <td><div class="badge badge-light-success"></div> {{$op->avgPrice}}  </td>
                  <!--end::Type=-->
                  <!--begin::Type=-->
                  <td><div class="badge badge-light-success"></div> @if($op->price < $op->avgPrice) {{$op->origQty}} @else  - {{$op->origQty}} @endif  </td>
                  <!--end::Type=-->
                  <!--begin::Category=-->
                  <td><div class="badge badge-light-success"></div> {{$op->created_at}}  </td>
                  <!--end::Category=-->
                  <!--begin::Category=-->
                  <td><div class="badge badge-light-success"></div> {{$op->updated_at}}  </td>
                  <!--end::Category=-->
                </tr>
                @endforeach
              <!--end::Table row-->
            </tbody>
            <!--end::Table body-->
          </table>
          <!--end::Table-->
          {{$closedOrders->links()}}
        </div>
        <!--end::Card body-->
      </div>
      <!--end::Category-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Content-->

</div>
