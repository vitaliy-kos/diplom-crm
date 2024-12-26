@extends('layouts.crm')

@section('content')
<div class="content-page">
   <div class="container-fluid">
      
      <div class="settings-page">
         <input type="hidden" name="token" value="Bearer scGz0URiSG99ds-nRCJPxWw46TJTBquXF58Qub8DL5V3b2gU5siU!qOUGcZSF0iPILyRjajOym">
         
         <div class="row">
            <div class="col-md-12 mb-4 mt-1">
               <div class="d-flex flex-wrap justify-content-center align-items-center">
                  <h4 class="font-weight-bold">Настройки</h4>
               </div>
            </div>
         </div>

         <div class="row mb-2">
            
            <div class="col-sm-3">
               <div class="nav flex-column nav-pills text-center card p-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                  <a class="nav-link mb-2 active" id="v-pills-common-tab" data-toggle="pill" href="#v-pills-common" role="tab" aria-controls="v-pills-common" aria-selected="true">Общие</a>

                  <a class="nav-link mb-2" id="v-pills-mango-tab" data-toggle="pill" href="#v-pills-mango" role="tab" aria-controls="v-pills-mango" aria-selected="false">Mango-office</a>

                  <a class="nav-link mb-2" id="v-pills-telegram-tab" data-toggle="pill" href="#v-pills-telegram" role="tab" aria-controls="v-pills-telegram" aria-selected="false">Telegram бот</a>

                  <!-- <a class="nav-link mb-2" id="v-pills-direct-tab" data-toggle="pill" href="#v-pills-direct" role="tab" aria-controls="v-pills-direct" aria-selected="false">Директ</a> -->

                  <!-- <a class="nav-link mb-2" id="v-pills-metrica-tab" data-toggle="pill" href="#v-pills-metrica" role="tab" aria-controls="v-pills-metrica" aria-selected="false">Метрика</a> -->
               </div>
            </div>

            <div class="col-sm-9">
               <div class="tab-content mt-0 card p-5" id="v-pills-tabContent">

                  <div class="tab-pane fade show active" id="v-pills-common" role="tabpanel" aria-labelledby="v-pills-common-tab">
                     <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <h4 class="font-weight-bold">Общие настройки</h4>
                     </div>
                     <div class="content mt-5">

                        <table class="table">
                           <tbody>
                              <tr>
                                 <td><b>Дополнительные функции</b>
                                    <br>Для включения данной функции необходима корректная <a href="#">настройка</a>
                                 </td>
                                 <td>
                                    <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                       <div class="custom-switch-inner">
                                          <input 
                                             type="checkbox" 
                                             class="custom-control-input autosave" 
                                             id="customSwitch-11" 
                                             name="distribution_is_included" 
                                             <?php // $settings?->distribution?->is_included ?? null ? 'checked=""' : '' ?> 
                                             <?php // !isset($settings?->distribution?->is_configured) || $settings?->distribution?->is_configured == 0 ? 'disabled=""' : '' ?> 
                                             value="1">
                                          <label class="custom-control-label" for="customSwitch-11" data-on-label="Вкл" data-off-label="Выкл">
                                          </label>
                                       </div>
                                    </div>
                                 </td>
                              </tr>

                           </tbody>
                        </table>

                     </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-mango" role="tabpanel" aria-labelledby="v-pills-mango-tab">
                     <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <h4 class="font-weight-bold">Mango-office</h4>
                     </div>
                     <div class="content mt-5">
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">API key</span>
                           </div>
                           <input 
                              type="text" 
                              name="mango_vpbx_api_key"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Ключ API"
                              value="{{ $settings['mango_vpbx_api_key']->value ?? null }}">
                        </div>
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">API salt</span>
                           </div>
                           <input 
                              type="text" 
                              name="mango_vpbx_api_salt"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Соль для доступа к манго"
                              value="{{ $settings['mango_vpbx_api_salt']->value ?? null }}">
                        </div>

                        <div class="d-flex justify-content-start align-items-center check_block">
                           <button 
                              type="button" 
                              class="btn btn-light check_button d-flex align-items-center pl-5 pr-5 position-relative"
                              data-class="Mango">Проверить соединение <i class="loading"></i></button>
                        </div>

                     </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-telegram" role="tabpanel" aria-labelledby="v-pills-telegram-tab">
                     <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <h4 class="font-weight-bold">Telegram бот</h4>
                     </div>
                     <div class="content mt-5">
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Token</span>
                           </div>
                           <input 
                              type="text" 
                              name="telegram_token"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Токен для доступа к боту"
                              value="{{ $settings['telegram_token']->value ?? null }}">
                        </div>
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">ID чата с уведомлениями</span>
                           </div>
                           <input 
                              type="text" 
                              name="telegram_notify_chat_id"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Для получения уведомлений о действиях в системе"
                              value="{{ $settings['telegram_notify_chat_id']->value ?? null }}">
                        </div>

                        <div class="d-flex justify-content-start align-items-center check_block">
                           <button 
                              type="button" 
                              class="btn btn-light check_button d-flex align-items-center pl-5 pr-5 position-relative"
                              data-class="Telegram">Проверить соединение <i class="loading"></i></button>
                        </div>

                     </div>
                  </div>

                  <!-- <div class="tab-pane fade" id="v-pills-direct" role="tabpanel" aria-labelledby="v-pills-direct-tab">
                     <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <h4 class="font-weight-bold">Я.Директ</h4>
                     </div>
                     <div class="content mt-5">
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Логин</span>
                           </div>
                           <input 
                              type="text" 
                              name="yadirect_login"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Логин в яндексе"
                              value="<?php // $settings?->yadirect?->login ?? null?>">
                        </div>
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Токен</span>
                           </div>
                           <input 
                              type="text" 
                              name="yadirect_token"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Токен для соединения с директом"
                              value="<?php // $settings?->yadirect?->token ?? null?>">
                        </div>

                        <div class="d-flex justify-content-start align-items-center check_block">
                           <button 
                              type="button" 
                              class="btn btn-light check_button d-flex align-items-center pl-5 pr-5 position-relative"
                              data-class="Yadirect">Проверить соединение <i class="loading"></i></button>
                        </div>

                     </div>
                  </div> -->

                  <!-- <div class="tab-pane fade" id="v-pills-metrica" role="tabpanel" aria-labelledby="v-pills-metrica-tab">
                     <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <h4 class="font-weight-bold">Я.Метрика</h4>
                     </div>
                     <div class="content mt-5">
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Счетчик</span>
                           </div>
                           <input 
                              type="text" 
                              name="yametrica_login"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Номер счетчика"
                              value="<?php // $settings?->yametrica?->login ?? null?>">
                        </div>
                        
                        <div class="input-group mb-4">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Токен</span>
                           </div>
                           <input 
                              type="text" 
                              name="yametrica_token"
                              class="form-control autosave"
                              spellcheck="false"
                              placeholder="Токен для соединения с Метрикой"
                              value="<?php // $settings?->yametrica?->token ?? null?>">
                        </div>

                        <div class="d-flex justify-content-start align-items-center check_block">
                           <button 
                              type="button" 
                              class="btn btn-light check_button d-flex align-items-center pl-5 pr-5 position-relative"
                              data-class="Yametrica">Проверить соединение <i class="loading"></i></button>
                        </div>

                     </div>
                  </div> -->

               </div>
            </div>

         </div>

      </div>
      
    <!-- Page end  -->
   </div>
</div>
@endsection