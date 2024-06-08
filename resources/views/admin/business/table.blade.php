<div>
    <x-loading-indicator/>

    {{-- 테이블 목록 card-box --}}
    <div class="card">
        <div class="card-header">
            {{-- 필터 --}}
            <x-flex>
                <button class="btn btn-primary" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFilter"
                    aria-expanded="false"
                    aria-controls="collapseFilter">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                    </svg>

                    조건필터
                </button>
            </x-flex>

            <div class="collapse" id="collapseFilter">
                <x-flex-between class="pt-2">
                    {{-- 페이징: 한페이지에 보여주는 데이터의 갯수 --}}
                    <div class="d-flex gap-2 align-items-center">
                        <label for="table-pasing-number" class="form-label">
                            페이징
                        </label>
                        <select class="form-select flex-grow-1"
                            id="table-pasing-number"  style="width: unset;"
                            wire:model.live="paging">
                            <option value='5'>5</option>
                            <option value='10'>10</option>
                            <option value='20'>20</option>
                            <option value='50'>50</option>
                            <option value='100'>100</option>
                        </select>
                    </div>

                    <div >
                        {{-- 필터를 적용시 filter.blade.php 를 읽어 옵니다. --}}
                        @if (isset($actions['view']['filter']))
                            <div class="row justify-content-center">
                                @includeIf($actions['view']['filter'])
                            </div>
                            <div class="d-flex justify-content-center justify-content-center gap-2">
                                <button class="btn btn-primary" wire:click="filter_search">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                    검색
                                </button>
                                <button class="btn btn-secondary" wire:click="filter_reset">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    취소
                                </button>
                            </div>
                        @endif
                    </div>
                </x-flex-between>
            </div>

            {{-- 메시지를 출력합니다. --}}
            @if (session()->has('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
        </div>
        <div class="card-body">
            {{-- 외부에서 지정한 목록 테이블을 출력합니다. --}}
            @if (isset($actions['view']['list']))
                @includeIf($actions['view']['list'])
            @endif

            @if(empty($rows))
            <div class="text-center">
                검색된 데이터 목록이 없습니다.
            </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div class="px-2 py-2">
                    전체 {{count($ids)}} 개가 검색되었습니다.
                </div>
                <div>
                    @if (isset($rows) && is_object($rows))
                        @if(method_exists($rows, "links"))
                        <div>{{ $rows->links() }}</div>
                        @else

                        @endif
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 테이블 제어기능 ---}}
    <div class="d-flex justify-content-between" style="margin-top:-16px;">
        {{-- 선택삭제 기능 --}}
        <div>
        @if(isset($actions['delete']['check']) && $actions['delete']['check'])
            <span id="selected-num">{{$selected_count}}</span>
            <span class="px-1">selected</span>

            @if ($selected_count)
            <button type="button" class="btn btn-danger btn-sm" id="selected-delete"
                wire:click="popupCheckDelete">선택삭제</button>
            @else
            <button type="button" class="btn btn-outline-secondary btn-sm" id="selected-delete"
                disabled>선택삭제</button>
            @endif
        @endif
        </div>

        {{-- 신규추가 버튼 --}}
        <div>

            @if(isset($actions['create']['enable']) && $actions['create']['enable'])
            {{-- WireTable내의 create 메소드를 호출합니다. --}}
            <button class="btn btn-primary btn-sm" wire:click="create">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
                @if(isset($actions['create']['title']))
                {{$actions['create']['title']}}
                @endif
            </button>
            @endif

        </div>
    </div>


    <!-- 팝업 데이터 수정창 -->
    @if ($popupForm)
    <x-wire-dialog-modal wire:model="popupForm" maxWidth="3xl">
        <x-slot name="title">
            @if (isset($actions['id']))
                {{ __('자료 수정') }}
            @else
                {{ __('신규 입력') }}
            @endif
        </x-slot>

        <x-slot name="content">
            @if(isset($actions['view']['form']))
                @includeIf($actions['view']['form'])
            @else
                입력폼 양식이 지정되지 않았습니다. <br>
                컨트롤러 actions의 view->form 항목을 설정해 주세요.
            @endif
        </x-slot>


        <x-slot name="footer">
            @if($message)
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @endif


        @if(isset($actions['view']['form']))

            @if (isset($actions['id']))
            {{-- 수정폼--}}
            <div class="flex justify-between">
                <div> {{-- 2단계 삭제 --}}
                    @if($popupDelete)
                    <span class="text-red-600">정말로 삭제를 진행할까요?</span>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="deleteConfirm">삭제</button>
                    @else
                    <button type="button" class="btn btn-danger" wire:click="delete">삭제</button>
                    @endif
                </div>
                <div> {{-- right --}}
                    <button type="button" class="btn btn-secondary"
                        wire:click="cancel">취소</button>
                    <button type="button" class="btn btn-info"
                        wire:click="update">수정</button>
                </div>
            </div>
            @else
            {{-- 생성폼 --}}
            <div class="flex justify-between">
                <div></div>
                <div class="text-right">
                    <button type="button" class="btn btn-secondary"
                        wire:click="cancel">취소</button>
                    <button type="button" class="btn btn-primary"
                        wire:click="store">저장</button>
                </div>
            </div>
            @endif
        @else
            <button type="button" class="btn btn-secondary"
                wire:click="cancel">취소</button>
        @endif
        </x-slot>
    </x-wire-dialog-modal>
    @endif

    {{-- 2단계 삭제 확인 컨펌 창 --}}
    {{-- @if($popupDelete)
        <x-wire-dialog-modal wire:model="popupDelete" maxWidth="2xl" opacity="opacity-30">
            <x-slot name="title">
                {{ __('레코드 삭제') }}
            </x-slot>

            <x-slot name="content">
                <div class="flex w-full p-5 space-x-5 lg:p-6 grow">
                    <div class="flex items-center justify-center flex-none w-16 h-16 bg-red-100 rounded-full">
                        <svg class="inline-block w-8 h-8 text-red-500 hi-solid hi-shield-exclamation"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="mb-1 text-xl font-semibold">
                            정말로 삭제를 진행할까요?
                        </h4>
                        <p class="text-gray-600">
                            삭제된 후에는 되돌리수 없습니다.
                        </p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-btn-danger-text wire:click="deleteCancel">
                    취소
                </x-btn-danger-text>
                <x-btn-danger wire:click="deleteConfirm">
                    예, 삭제를 진행합니다.
                </x-btn-danger>
            </x-slot>
        </x-wire-dialog-modal>
    @endif --}}


{{-- 선택삭제 팝업 확인창 --}}
@if(isset($actions['delete']['check']) && $actions['delete']['check'])
    @if ($checkDelete)
    <x-table-dialog-modal wire:model="checkDelete" maxWidth="3xl">
        <x-slot name="title">
            {{ __('선택삭제') }}
        </x-slot>

        <x-slot name="content">
            <p class="p-8">선택한 항목을 삭제하시겠습니까?</p>
        </x-slot>

        <x-slot name="footer">
            <x-flex-between>
                <div>
                    <button type="button" class="btn btn-secondary"
                        wire:click="popupCheckDeleteClose">
                        취소
                    </button>
                </div>
                <div>
                    @if($checkDeleteConfirm)
                    정말로 삭제할까요?
                    <button type="button" class="btn btn-danger"
                        wire:click="checkeDeleteRun">
                        예
                    </button>
                    @else
                    <button type="button" class="btn btn-danger"
                        wire:click="checkeDeleteConfirm">
                        삭제
                    </button>
                    @endif
                </div>
            </x-flex-between>
        </x-slot>
    </x-table-dialog-modal>
    @endif
@endif


    {{-- 퍼미션 알람--}}
    @include("jiny-wire-table::error.popup.permit")

</div>
