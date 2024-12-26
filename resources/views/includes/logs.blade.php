<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h5 class="card-title">История действий</h5>
        </div>
    </div>
    <div class="card-body">
        <ul class="requests_in_client list-group">
            @if(isset($logs))
                <?php $counter = 0; ?>
                @foreach($logs as $log)
                    <li class="log list-group-item list-group-item-action @if ($counter >= 5) d-none @endif">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $log->title }}</h6>
                            <!-- <small class="text-muted"></small> -->
                        </div>
                        <p class="mb-1">{{ $log->date }}</p>
                        <p class="mb-1"><b>{{ $log->act }}</b></p>
                        <!-- <small class="text-muted"></small> -->
                    </li>
                    <?php $counter++; ?>
                @endforeach
                @if (count($logs) > 5) 
                    <div class="mt-2 d-flex justify-content-center">
                        <a href="#" class="show_more_logs">Показать больше</a>
                    </div>
                @endif
            @else
                <p>История действий отсутствует.</p>
            @endif

        </ul>
    </div>
</div>
