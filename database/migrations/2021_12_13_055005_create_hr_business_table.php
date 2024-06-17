<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_business', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('enable')->default(1);

            $table->string('name')->nullable();

            // 회사 로고 이미지
            $table->string('logo')->nullable();


            // 관리단위
            // 인사1팀, 인사2팀, IT지원팀 등 부서/팀과 같이 관리 단위가 나뉘는 경우 → 조직 사용
            // 서울역점, 강남역점, 하남 스타필드점과 같이 관리 단위가 나뉘는 경우 → 지점 사용
            $table->string('hr_type')->nullable();

            // 한주의 시작요일 예)월요일
            $table->string('hr_start_day')->nullable();

            // 기업의 소속국가
            // 공휴일등의 계산은 각 국가별로 지정됨
            $table->string('country')->nullable();

            ## 비고
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_business');
    }
}
