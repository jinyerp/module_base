<x-row >
    <x-col class="col-8">
        <div class="page-title-box">
            <ol class="m-0 breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                @foreach (explode("/",$actions['route']['uri']) as $item)
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{$item}}</a></li>
                @endforeach
            </ol>

            <div class="mb-3">
                <h1 class="align-middle h3 d-inline">사업장 관리</h1>
                <p>

                </p>
            </div>
        </div>
    </x-col>
</x-row>
