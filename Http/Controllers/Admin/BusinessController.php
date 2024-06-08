<?php
namespace Jiny\Erp\Base\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class BusinessController extends WireTablePopupForms
{

    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ## 테이블 정보
        $this->actions['table'] = "hr_business";

        // 컨트롤러 페이지 레이아웃
        $this->actions['view']['layout'] = "jinyerp-base::admin.business.layout";

        // 테이블 레이아웃
        $this->actions['view']['table'] = "jinyerp-base::admin.business.table";

        $this->actions['view']['title'] = "jinyerp-base::admin.business.title";
        $this->actions['view']['list'] = "jinyerp-base::admin.business.list";
        $this->actions['view']['form'] = "jinyerp-base::admin.business.form";


    }



}
