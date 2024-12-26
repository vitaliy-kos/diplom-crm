@extends('layouts.crm')

@section('content')
<div class="content-page main_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4 mt-1">

                <form action="/admin-sale/" method="GET" class="d-flex flex-wrap justify-content-between align-items-center">

                    <div class="col-sm-12 col-md-4 col-lg-5">
                        <h4 class="font-weight-bold">Рабочий стол</h4>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-5">
                        <div class="form-group mb-0 vanila-daterangepicker d-flex flex-row" id="datesForStat">
                            <div class="date-icon-set">
                                <input type="text" 
                                       name="stat_start" 
                                       value="<?php //echo $stat_start; ?>"
                                       class="form-control date-icon" 
                                       placeholder="Начало периода" 
                                       autocomplete="off"
                                       inputmode="none">
                            </div>
                            <span class="flex-grow-0">
                                <span class="btn">По</span>
                            </span>
                            <div class="date-icon-set">
                                <input 
                                    type="text" 
                                    name="stat_finish" 
                                    value="<?php //echo $stat_finish; ?>"
                                    class="form-control" placeholder="Конец периода" autocomplete="off"
                                    inputmode="none">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2 text-center">
                        <input type="submit" value="Применить" class="btn btn-outline-secondary sml-btn pt-0 pb-0 mb-1">
                    </div>
                </form>

            </div>
            <div class="col-lg-8 col-md-12">

                <div class="row">

                    <div class="col-md-3 mob-w-50">
                        <a href="/admin-sale?section=orders&filter=all">
                            <div class="card bg-success">
                                <div class="card-body d-flex flex-column">

                                    <div class="d-flex">
                                        <div class="w-25 ml-2">
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/>
                                                </svg>
                                            </i>
                                        </div>
                                        <div class="m-auto">
                                            <h4 class="text-white font-weight-bold"><?php
                                                //echo $got_orders_today > 0 ? $got_orders_today : 0;
                                            ?></h4>
                                        </div>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <small>Заказов сегодня</small>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mob-w-50">
                        <a href="/admin-sale?section=orders&filter=away">
                            <div class="card bg-warning">
                                <div class="card-body d-flex flex-column">

                                    <div class="d-flex">
                                        <div class="w-25 ml-2">
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
                                                </svg>
                                            </i>
                                        </div>
                                        <div class="m-auto">
                                            <h4 class="text-white font-weight-bold"><?php
                                                //echo $orders_away[0]->away > 0 ? $orders_away[0]->away : 0;
                                            ?></h4>
                                        </div>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <small>На выезде</small>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mob-w-50">
                        <a href="/admin-sale?section=orders&filter=gospit">
                            <div class="card bg-primary">
                                <div class="card-body d-flex flex-column">

                                    <div class="d-flex">
                                        <div class="w-25 ml-2">
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"></path>
                                                </svg>
                                            </i>
                                        </div>
                                        <div class="m-auto">
                                            <h4 class="text-white font-weight-bold"><?php
//                                                echo $orders_gosp[0]->gosp;
//                                                if ($orders_gosp_today[0]->gosp > 0) {
//                                                    echo ' <small>(+' . $orders_gosp_today[0]->gosp . ')</small>';
//                                                }
                                            ?></h4>
                                        </div>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <small>Не обработано</small>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mob-w-50">
                        <a href="/admin-sale?section=orders&filter=reba">
                            <div class="card bg-secondary">
                                <div class="card-body d-flex flex-column">

                                    <div class="d-flex">
                                        <div class="w-25 ml-2">
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                                                </svg>
                                            </i>
                                        </div>
                                        <div class="m-auto">
                                            <h4 class="text-white font-weight-bold"><?php
//                                                echo $orders_reba[0]->reba;
//                                                if ($orders_reba_today[0]->reba > 0) {
//                                                    echo ' <small>(+' . $orders_reba_today[0]->reba . ')</small>';
//                                                }
                                            ?></h4>
                                        </div>

                                    </div>

                                    <div class="mt-2 text-center">
                                        <small>В работе</small>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">Суммарный оборот</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><?php
                                                //echo $Crm->convertMoneyToPeople($summary_turn);
                                            ?></h6>
                                            <input type="hidden" class="summary_turn" value="<?php //echo $summary_turn; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">ПРИХОДЫ + ПРОЧИЕ</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><?php
                                              //echo $Crm->convertMoneyToPeople($summary_income) . ' + ' . $Crm->convertMoneyToPeople($other_incomes);
                                              ?></h6>
                                            <input type="hidden" class="summary_income"
                                                   value="<?php //echo $summary_income; ?>">
                                            <input type="hidden" class="other_incomes"
                                                   value="<?php // echo $other_incomes > 0 ? $other_incomes : 0; ?>">
                                            <!-- <p class="mb-0 ml-2 text-success font-weight-bold"><?php
                                                // $per_inc = round($summary_income * 100 / $summary_turn, 1);
                                                // if (is_nan($per_inc)) $per_inc = 0;
//                                                                                                        echo $per_inc . '%';
                                                ?>
                                                </p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body animated-background get-data-method"
                                 data-method="get_ya_direct_summary_expense">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">ДИРЕКТ + ПРОЧИЕ</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><span></span> + <?php
//                                                  echo $Crm->convertMoneyToPeople($other_expenses);
                                              ?></h6>
                                            <input type="hidden" class="ya_direct_summary_expense" value="">
                                            <input type="hidden" class="other_expenses"
                                                   value="<?php //echo $other_expenses > 0 ? $other_expenses : 0; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                    <div class="">
                                        <p class="mb-2 text-secondary">Обращ. / Заказ. / День</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><?php
//                                                  $date_st = strtotime($stat_start);
//                                                  $date_fin = strtotime($stat_finish);
//
//                                                  $days = round(($date_fin - $date_st) / (60 * 60 * 24)) + 1;
//
//                                                  $per_day = round($sum_good_orders / $days, 1);
//                                                  if (is_nan($per_day)) $per_day = 0;
//
//                                                  echo $sum_requsts . ' / ' . $sum_good_orders . ' / ' . $per_day;
                                              ?></h6>
                                            <p class="mb-0 ml-3 text-success font-weight-bold"><?php
//                                                   if ($sum_requsts > 0) {
//                                                       echo round($sum_good_orders * 100 / $sum_requsts, 1) . '%';
//                                                   }
                                               ?>
                                            </p>
                                            <input type="hidden" class="sum_good_orders"
                                                   value="<?php //echo $sum_good_orders; ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="col-md-4">
              <div class="card">
                 <div class="card-body">
                    <div class="d-flex align-items-center">

                       <div class="">
                          <p class="mb-2 text-secondary">Сред. чек ОБЩИЙ</p>
                          <div class="d-flex flex-wrap justify-content-start align-items-center">
                             <h6 class="mb-0 font-weight-bold"><?php
                                                                                           // $mid_com = $summary_turn / $sum_good_orders;
                                                                                           // if (is_nan($mid_com)) $mid_com = 0;
                                                                                           // echo $Crm->convertMoneyToPeople($mid_com);
                                                                                           ?></h6>
                          </div>
                       </div>

                    </div>
                 </div>
              </div>
           </div> -->


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body animated-background fixed_income">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">Прибыль полученная</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"></h6>
                                            <input type="hidden" class="income_fixed" value="">
                                            <p class="income_fixed_val mb-0 ml-2 text-success font-weight-bold"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body animated-background get-data-method"
                                 data-method="get_ya_direct_today">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">Не оплачено / Директ</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><?php
//                                                  echo $Crm->convertMoneyToPeople($waiting_profit_today);
                                              ?> / <span></span></h6>
                                            <input type="hidden" class="waiting_profit_today"
                                                   value="<?php //echo $waiting_profit_today; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body animated-background">
                                <div class="d-flex align-items-center">

                                    <div class="">
                                        <p class="mb-2 text-secondary">Чек НАШ / ЛИД</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"><?php
                                                                              // $mid_our = $summary_income / $sum_good_orders;
                                                                              // if (is_nan($mid_our)) $mid_our = 0;
                                                                              // echo $Crm->convertMoneyToPeople($mid_our) . ' / <span class="lead_price"></span>';
                                                                              ?></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body animated-background get-data-method"
                                 data-method="get_ya_direct_balance">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">Баланс Я.Директ</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body animated-background get-data-method"
                                 data-method="get_mango_balance">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-2 text-secondary">Баланс Mango</p>
                                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                                            <h6 class="mb-0 font-weight-bold"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                    <h4 class="font-weight-bold">Приходы и расходы</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="primary"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="3" width="18" height="18" rx="2" fill="#47A76A"/>
                                            </svg>
                                            <span>Приходы</span>
                                        </div>
                                        <div class="ml-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="3" width="18" height="18" rx="2" fill="#FF2B2B"/>
                                            </svg>
                                            <span>Расходы</span>
                                        </div>
                                        <!-- <div class="ml-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <rect x="3" y="3" width="18" height="18" rx="2" fill="#42AAFF" />
                                                          </svg>
                                           <span>Заказы</span>
                                        </div> -->
                                    </div>
                                </div>
                                <div id="chart-apex-column-01" class="custom-chart animated-background"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                    <h4 class="font-weight-bold">Чистая прибыль</h4>
                                </div>
                                <div id="chart-apex-column-profit" class="custom-chart animated-background"
                                     style="min-height: 350px;"></div>
                            </div>
                        </div>

                        <!-- <div class="card">
                            <div class="card-body">
                              <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                 <h4 class="font-weight-bold">Стоимость лида</h4>
                              </div>
                              <div id="chart-apex-column-lead" class="custom-chart animated-background" style="min-height: 350px;"></div>
                            </div>
                        </div> -->

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                    <h4 class="font-weight-bold">Маркетинг</h4>
                                </div>
                                <div id="chart-apex-column-10" class="custom-chart animated-background"
                                     style="min-height: 350px;"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                    <h4 class="font-weight-bold">Заказы по часам</h4>
                                </div>
                                <div id="chart-apex-column-11" class="custom-chart animated-background"
                                     style="min-height: 350px;"></div>
                            </div>
                        </div>

                        <!-- <div class="card">
                           <div class="card-body">
                              <h4 class="font-weight-bold mb-3">Статистика по городам</h4>
                              <div id="chart-map-column-04" class="custom-chart"></div>
                           </div>
                        </div> -->

                    </div>


                    <div class="col-md-12">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Предстоящие события</h4>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <a href="#" class="text-muted pl-3" id="dropdownMenuButton-event"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor"
                                                 stroke-width="2" aria-hidden="true" focusable="false"
                                                 style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                                 preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                                <g fill="none" stroke-width="2" stroke-linecap="round"
                                                   stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="1"/>
                                                    <circle cx="19" cy="12" r="1"/>
                                                    <circle cx="5" cy="12" r="1"/>
                                                </g>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-event">
                                            <a class="dropdown-item" href="#">
                                                <svg class="svg-icon text-secondary" width="20"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Редактировать
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <svg class="svg-icon text-secondary" width="20"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Открыть
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <svg class="svg-icon text-secondary" width="20"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-spacing mb-0">
                                        <tbody>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <h6 class="mb-0 text-uppercase text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    30 июня
                                                </h6>
                                            </td>
                                            <td class="pl-0 py-3">
                                                Оплата связи
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <h6 class="mb-0 text-uppercase text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    09 июля
                                                </h6>
                                            </td>
                                            <td class="pl-0 py-3">
                                                Оплата директа
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <h6 class="mb-0 text-uppercase text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    15 августа
                                                </h6>
                                            </td>
                                            <td class="pl-0 py-3">
                                                Позвонить клиенту
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <h6 class="mb-0 text-uppercase text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    26 октября
                                                </h6>
                                            </td>
                                            <td class="pl-0 py-3">
                                                Позвонить клиенту
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="d-flex justify-content-end align-items-center border-top-table p-3">
                                    <button class="btn btn-secondary btn-sm">Смотреть все</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


            <div class="col-lg-4 col-md-8">

                <div class="card card-block">
                    <div class="card-header card-header-border d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Популярные услуги</h4>
                        </div>
                    </div>
                    <div class="card-body-list">
                        <ul class="list-style-3 mb-0">
                            <?php
//                                foreach ($services_stat as $service) {
//                                    ?><!---->
                            <li class="p-1 list-item d-flex justify-content-start align-items-center">
                                <div class="list-style-detail ml-3 mr-2">
                                    <p class="mb-0">
                                        <b><?php ////echo empty($service->name) ? 'Не выбрана' : $service->name; ?><!----></b>
                                    </p>
                                    <p class="mb-0">Кол-во: <?php ////echo $service->sum; ?><!----></p>
                                    <p class="mb-0">
                                        Процент: <?php ////echo round($service->sum * 100 / $sum_good_orders); ?><!---->%</p>
                                    <p class="mb-0">
                                        Сумма: <?php ////echo $Crm->convertMoneyToPeople($service->sum_pay); ?><!----></p>
                                    <p class="mb-0">
                                        Нам: <?php ////echo $Crm->convertMoneyToPeople($service->sum_profit); ?><!----></p>
                                </div>
                                <div class="list-style-action d-flex justify-content-end ml-auto pr-3">
                                    <div>
                                        <h6 class="font-weight-bold"><?php ////echo $Crm->convertMoneyToPeople($service->avg); ?><!----></h6>
                                        <h6 class="text-success"><?php ////echo $Crm->convertMoneyToPeople($service->avg_our); ?><!----></h6>
                                    </div>
                                </div>
                            </li>
                                <?php
//                                }
                            ?>
                        </ul>
                    </div>
                </div>


                <div class="card card-block">
                    <div class="card-header card-header-border d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Популярные города</h4>
                        </div>
                    </div>
                    <div class="card-body-list">
                        <ul class="list-style-3 mb-0">
                            <?php
//                                //foreach ($cities_stat as $city) {
//                                    ?><!---->
                            <li class="p-1 list-item d-flex justify-content-start align-items-center">
                                <div class="list-style-detail ml-3 mr-2">
                                    <p class="mb-0">
                                        <b><?php ////echo $city->city == 0 ? 'Не выбран' : $cities_list[$city->city]->name_ru; ?><!----></b>
                                    </p>
                                    <p class="mb-0">Кол-во: <?php ////echo $city->sum; ?><!----></p>
                                    <p class="mb-0">
                                        Процент: <?php ////echo round($city->sum * 100 / $sum_good_orders); ?><!---->%</p>
                                    <p class="mb-0">
                                        Сумма: <?php ////echo $Crm->convertMoneyToPeople($city->sum_pay); ?><!----></p>
                                    <p class="mb-0">
                                        Нам: <?php ////echo $Crm->convertMoneyToPeople($city->sum_profit); ?><!----></p>
                                </div>
                                <div class="list-style-action d-flex justify-content-end ml-auto pr-3">
                                    <div>
                                        <h6 class="font-weight-bold"><?php ////echo $Crm->convertMoneyToPeople($city->avg); ?><!----></h6>
                                        <h6 class="text-success"><?php ////echo $Crm->convertMoneyToPeople($city->avg_our); ?><!----></h6>
                                    </div>
                                </div>
                            </li>
                                <?php
//                                }
//                                ?>
                        </ul>
                    </div>
                </div>

            </div>


            <div class="col-md-4">
                <div class="row">

                    <!-- <div class="col-md-12">
                       <div class="card">
                          <div class="card-body">
                             <div class="d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold">Active Users</h6>
                                <div class="d-flex align-items-center">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                   </svg>
                                   <span class=" font-weight-bold">200</span>
                                </div>
                             </div>
                             <p class="mb-0">Pages views per day</p>
                             <div id="chart-apex-column-02" class="custom-chart"></div>
                             <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 pt-3 ">25 June</p>
                                <p class="mb-0 pt-3 ">26 June</p>
                                <p class="mb-0 pt-3 ">27 June</p>
                             </div>
                          </div>
                       </div>
                    </div> -->
                </div>
            </div>

            <!-- <div class="col-lg-4 col-md-6">
               <div class="card">
                  <div class="card-body">
                     <h4 class="font-weight-bold mb-3">Структура услуг</h4>
                     <div id="chart-apex-column-03" class="custom-chart"></div>
                     <div class="d-flex justify-content-around align-items-center">
                        <div><svg width="24" height="24" viewBox="0 0 24 24" fill="#ffbb33" xmlns="http://www.w3.org/2000/svg">
                              <rect x="3" y="3" width="18" height="18" rx="2" fill="#ffbb33" />
                              </svg>

                              <span>Капельница</span>
                        </div>
                     </div>
                     <div class="d-flex justify-content-around align-items-center mt-3">
                        <div>
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="primary" xmlns="http://www.w3.org/2000/svg">
                              <rect x="3" y="3" width="18" height="18" rx="2" fill="#04237D" />
                              </svg>

                              <span>Стационар</span>
                        </div>
                        <div>
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="primary" xmlns="http://www.w3.org/2000/svg">
                              <rect x="3" y="3" width="18" height="18" rx="2" fill="#8080ff" />
                              </svg>

                              <span>Кодировка</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div> -->
            <!-- <div class="col-lg-8 col-md-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Новые клиенты</h4>
                     </div>
                     <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                              <a href="#" class="text-muted pl-3" id="dropdownMenuButton-customer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <g fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                       <circle cx="12" cy="12" r="1"/>
                                       <circle cx="19" cy="12" r="1"/>
                                       <circle cx="5" cy="12" r="1"/></g>
                                 </svg>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-customer">
                                 <a class="dropdown-item" href="#">
                                       <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                       </svg>
                                       Редактировать
                                 </a>
                                 <a class="dropdown-item" href="#">
                                       <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                       </svg>
                                       Просмотр
                                 </a>
                                 <a class="dropdown-item" href="#">
                                       <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                       </svg>
                                       Удалить
                                 </a>
                              </div>
                           </div>
                     </div>
                  </div>
                  <div class="card-body p-0">
                     <div class="table-responsive">
                        <table class="table mb-0">
                           <thead class="table-color-heading">
                              <tr class="text-secondary">
                                 <th scope="col">Дата</th>
                                 <th scope="col">Клиент</th>
                                 <th scope="col">Статус</th>
                                 <th scope="col" class="text-right">Сумма чека</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="white-space-no-wrap">
                                 <td>01 Jun 2020</td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <div class="avatar-45 mr-2">
                                          <img src="/wp-content/themes/kivicare/crm-template/assets/images/user/2.jpg" class="img-fluid rounded-circle"
                                             alt="image">
                                       </div>
                                       <div>Maggie Potts</div>
                                    </div>
                                 </td>
                                 <td>
                                    <p class="mb-0 text-success d-flex justify-content-start align-items-center">
                                       <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">
                                       <circle cx="12" cy="12" r="8" fill="#3cb72c"></circle></svg>
                                       </small> Completed
                                    </p>
                                 </td>
                                 <td class="text-right">$104.98</td>
                              </tr>
                              <tr class="white-space-no-wrap">
                                 <td>02 Jun 2020</td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <div class="avatar-45 mr-2">
                                          <img src="/wp-content/themes/kivicare/crm-template/assets/images/user/5.jpg" class="img-fluid rounded-circle"
                                             alt="image">
                                       </div>
                                       <div>Kevin Adkins</div>
                                    </div>
                                 </td>
                                 <td>
                                    <p class="mb-0 text-success d-flex justify-content-start align-items-center">
                                       <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">
                                       <circle cx="12" cy="12" r="8" fill="#3cb72c"></circle></svg>
                                       </small> Completed
                                    </p>
                                 </td>
                                 <td class="text-right">$233.00</td>
                              </tr>
                              <tr class="white-space-no-wrap">
                                 <td>05 Jun 2020</td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <div class="avatar-45 mr-2">
                                          <img src="/wp-content/themes/kivicare/crm-template/assets/images/user/1.jpg" class="img-fluid rounded-circle"
                                             alt="image">
                                       </div>
                                       <div>Max Lynn</div>
                                    </div>
                                 </td>
                                 <td>
                                    <p class="mb-0 text-warning d-flex justify-content-start align-items-center">
                                       <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">
                                       <circle cx="12" cy="12" r="8" fill="#db7e06"></circle></svg>
                                       </small>Pending
                                    </p>
                                 </td>
                                 <td class="text-right">$150.01</td>
                              </tr>
                              <tr class="white-space-no-wrap">
                                 <td>06 Jun 2020</td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <div class="avatar-45 mr-2">
                                          <img src="/wp-content/themes/kivicare/crm-template/assets/images/user/3.jpg" class="img-fluid rounded-circle"
                                             alt="image">
                                       </div>
                                       <div>Danniw Yatt</div>
                                    </div>
                                 </td>
                                 <td>
                                    <p class="mb-0 text-danger d-flex justify-content-start align-items-center">
                                       <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">
                                       <circle cx="12" cy="12" r="8" fill="#F42B3D"></circle></svg>
                                       </small>Cancelled
                                    </p>
                                 </td>
                                 <td class="text-right">$199.99</td>
                              </tr>
                           </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center border-top-table p-3">
                                 <button class="btn btn-secondary btn-sm">Смотреть все</button>
                              </div>
                     </div>
                  </div>
               </div>
            </div> -->

        </div>
    </div>
</div>
@endsection
