<x-theme theme="admin.sidebar2">
    <x-theme-layout>
        <!-- start page title -->
        <x-row >
            <x-col class="col-8">
                <div class="page-title-box">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="/hr">Hr</a></li>
                        <li class="breadcrumb-item"><a href="/hr/admin">Admin</a></li>
                        <li class="breadcrumb-item active">Business</li>
                    </ol>

                    <div class="mb-3">
                        <h1 class="align-middle h3 d-inline">사업장</h1>
                        <p>

                        </p>
                    </div>
                </div>
            </x-col>
        </x-row>
        <!-- end page title -->

        <x-row>
            <x-col>
                @livewire('HrForm', ['actions'=>$actions])
            </x-col>
        </x-row>



    </x-theme-layout>
</x-theme>

