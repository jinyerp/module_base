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

        ## 지니ERP 업무관리자 공용 레이아웃
        //$this->actions['view']['layout'] = "jinyerp-base::layouts.www_admin";
        //$this->actions['view']['sidebar'] = "jinyerp-base::layouts.www_admin_sidebar"; // 사이드 메뉴


        $this->actions['view']['list'] = "jinyerp-base::admin.business.list";
        $this->actions['view']['form'] = "jinyerp-base::admin.business.form";

        $this->actions['title'] = "사업장관리";
        $this->actions['subtitle'] = "HR 적용 사업장을 관리합니다.";

        // 레이아웃 전환
        //$this->setLayout('www');

        // 테마를 적용합니다.
        $this->setTheme("jinyerp/hr-admin");

    }


}
