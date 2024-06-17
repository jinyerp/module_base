<x-www-layout>
    <section class="py-4 bg-gray-200">
        <div class="container px-5">
            {{-- Title --}}
            @if(isset($actions['view']['title']))
                @includeIf($actions['view']['title'])
            @else
                @includeIf("jiny-wire-table::table_popup_forms.title")
            @endif
        </div>
    </section>

    <section class="py-4">
        <div class="container px-5">

            <x-flex-between class="gap-4 -mx-2">
                <aside style="width:180px;">
                @if(isset($actions['view']['sidebar']))
                    @includeIf($actions['view']['sidebar'])
                @endif
                </aside>

                <main class="flex-grow-1">
                @if(isset($actions['view']['main']))
                    @includeIf($actions['view']['main'])
                @endif
                </main>
            </x-flex-between>
        </div>
    </section>

</x-www-layout>
