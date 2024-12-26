(function(jQuery) {

    "use strict";

    var date_start = $('input[name="stat_start"]').val();
    var date_finish = $('input[name="stat_finish"]').val();

    var incomes_data = [];
    var incomes_by_creation_data = [];
    var expenses_data = [];
    var direct_expenses = [];
    var profit = [];

    var requests_data = [];
    var orders_data = [];
    var realizaciya = [];
    var got_orders = [];

    var orders_by_hour = [];

    var lead_cost = [];

    var incomes_data_month = [];
    var expenses_data_month = [];
    var direct_expenses_month = [];
    var turn_data_month = [];
    var orders_data_month = [];
    var got_orders_month = [];
    var requests_data_month = [];
    var profit_data_month = [];
    var lead_cost_month = [];


    // if (date_start && date_finish) {
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getExpensesByDays",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //             data: 'direct'
    //         },
    //         success: function(data) {
    //             direct_expenses = Object.values($.parseJSON(data));
    //             countLead();
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getGotOrdersByDays",
    //             date_start: date_start,
    //             date_finish: date_finish
    //         },
    //         success: function(data) {
    //             got_orders = Object.values($.parseJSON(data));
    //             countLead();
    //             countRealizaciya();
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getTurnByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //
    //         },
    //         success: function(data) {
    //             turn_data_month = Object.values($.parseJSON(data));
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getExpensesByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //             data: 'all'
    //
    //         },
    //         success: function(data) {
    //             expenses_data_month = Object.values($.parseJSON(data));
    //             countMonthProfit();
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getExpensesByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //             data: 'direct'
    //
    //         },
    //         success: function(data) {
    //             direct_expenses_month = Object.values($.parseJSON(data));
    //             countMonthLead();
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getGotOrdersByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish
    //         },
    //         success: function(data) {
    //             got_orders_month = Object.values($.parseJSON(data));
    //             countMonthLead();
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getIncomesByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //         },
    //         success: function(data) {
    //             incomes_data_month = Object.values($.parseJSON(data));
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getOrdersByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //         },
    //         success: function(data) {
    //             orders_data_month = Object.values($.parseJSON(data));
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //         url: '/get-data.php',
    //         type: 'POST',
    //         async: true,
    //         data: {
    //             action: "getRequestsByMonth",
    //             date_start: date_start,
    //             date_finish: date_finish,
    //         },
    //         success: function(data) {
    //             requests_data_month = Object.values($.parseJSON(data));
    //             if (date_start == '01.05.2023') {
    //               requests_data_month.unshift({x:'2023-06', y:'0'});
    //               requests_data_month.unshift({x:'2023-05', y:'0'});
    //             }
    //             if (date_start == '01.06.2023') {
    //               requests_data_month.unshift({x:'2023-06', y:'0'});
    //             }
    //
    //             check_datas();
    //         },
    //   });
    //
    //   $.ajax({
    //       url: '/get-data.php',
    //       type: 'POST',
    //       async: true,
    //       data: {
    //           action: "getExpensesByDays",
    //           date_start: date_start,
    //           date_finish: date_finish,
    //           data: 'all'
    //       },
    //       success: function(data) {
    //           expenses_data = Object.values($.parseJSON(data));
    //
    //           var todayDate = new Date(new Date().setHours(new Date().getHours() + 3)).toISOString().slice(0, 10);
    //
    //           if (expenses_data.length > incomes_data.length)
    //             incomes_data.push({x:todayDate, y:"0"});
    //
    //           if (expenses_data.length > got_orders.length)
    //             got_orders.push({x:todayDate, y:"0"});
    //
    //           if (expenses_data.length > orders_data.length)
    //             orders_data.push({x:todayDate, y:"0"});
    //
    //           if (expenses_data.length > incomes_by_creation_data.length)
    //             incomes_by_creation_data.push({x:todayDate, y:"0"});
    //
    //           countProfit();
    //
    //           check_datas();
    //       },
    //   });
    //
    //   $.ajax({
    //       url: '/get-data.php',
    //       type: 'POST',
    //       async: true,
    //       data: {
    //           action: "getIncomesByDays",
    //           date_start: date_start,
    //           date_finish: date_finish
    //       },
    //       success: function(data) {
    //           incomes_data = Object.values($.parseJSON(data));
    //
    //           check_datas();
    //       },
    //   });
    //
    //   $.ajax({
    //       url: '/get-data.php',
    //       type: 'POST',
    //       async: true,
    //       data: {
    //           action: "getIncomesByDaysCreation",
    //           date_start: date_start,
    //           date_finish: date_finish
    //       },
    //       success: function(data) {
    //           incomes_by_creation_data = Object.values($.parseJSON(data));
    //
    //           check_datas();
    //       },
    //   });
    //
    //   $.ajax({
    //       url: '/get-data.php',
    //       type: 'POST',
    //       async: true,
    //       data: {
    //           action: "getRequestsOrdersByDays",
    //           date_start: date_start,
    //           date_finish: date_finish
    //       },
    //       success: function(data) {
    //           requests_data = Object.values($.parseJSON(data)[0]);
    //           orders_data = Object.values($.parseJSON(data)[1]);
    //
    //           countRealizaciya();
    //           check_datas();
    //       },
    //   });
    //
    //
    //
    // }

    function check_datas() {

      if(
          jQuery(".table-full_stat").length &&
          $("#full-stat-by-day-chart").html().length == 0 &&
          incomes_data.length > 0 &&
          expenses_data.length > 0 ) fillTableFullStatDaily();

      if(
          jQuery(".table-full_stat_month").length &&
          $("#full-stat-by-month-chart").html().length == 0 &&
          expenses_data_month.length > 0 &&
          orders_data_month.length > 0 &&
          requests_data_month.length > 0 &&
          turn_data_month.length > 0 &&
          lead_cost_month.length > 0 &&
          incomes_data_month.length > 0 ) fillTableFullStatMonth();

      if(
          jQuery("#chart-apex-column-01").length &&
          $("#chart-apex-column-01").html().length == 0 &&
          incomes_data.length > 0 &&
          expenses_data.length > 0 ) fillChartIncomesExpenses();

      if(
          jQuery("#chart-apex-column-10").length &&
          $("#chart-apex-column-10").html().length == 0 &&
          requests_data.length > 0 &&
          lead_cost.length > 0 &&
          profit.length > 0 &&
          incomes_by_creation_data.length > 0 &&
          orders_data.length > 0 ) ordersRequestsRender();

      if(
          jQuery("#chart-apex-column-profit").length &&
          $("#chart-apex-column-profit").html().length == 0 &&
          profit.length > 0 ) profit_render();

    }

    function fillTableFullStatDaily(){

      var table = $(".table-full_stat");
      var sum_expenses = [];
      var sum_profit = [];
      var sum_lead = [];

      $.each(expenses_data, function(key,value) {
        var row_tr = table.find('input[value="' + value.x + '"]').closest('tr');
        var val = Math.round(value.y * 100) / 100;
        sum_expenses.push(val);

        var income = row_tr.find('td.incomes input').val();
        var orders = row_tr.find('td.orders input').val();

        var profit = income - value.y;
        sum_profit.push(profit);

        row_tr.find('td.expenses div').html(Math.round(val).toLocaleString('ru') + '  ₽').removeClass('animated-background');
        row_tr.find('td.profit div').html(Math.round(profit).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      });

      $.each(lead_cost, function(key,value) {

        var row_tr = table.find('input[value="' + value.x + '"]').closest('tr');

        var lead = parseInt(value.y);
        if (lead == Number.POSITIVE_INFINITY || lead == Number.NEGATIVE_INFINITY || lead > 70000) {
          lead = 0;
        }
        else {
          sum_lead.push(lead);
        }

        row_tr.find('td.lead_price div').html(Math.round(lead).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      });

      var mid_lead = Math.round(sum_lead.reduce((partialSum, a) => partialSum + a, 0) / sum_lead.length * 100) / 100;

      var sum_profit_number = sum_profit.reduce((partialSum, a) => partialSum + a, 0);
      var mid_profit = Math.round(sum_profit_number / sum_profit.length * 100) / 100;

      var sum_expenses_number = sum_expenses.reduce((partialSum, a) => partialSum + a, 0);
      var mid_expenses = Math.round(sum_expenses_number / sum_expenses.length * 100) / 100;

      table.find('tfoot td.lead_price div').html(Math.round(mid_lead).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      table.find('tfoot td.sum_profit div').html(Math.round(sum_profit_number).toLocaleString('ru') + '  ₽').removeClass('animated-background');
      table.find('tfoot td.mid_profit div').html(Math.round(mid_profit).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      table.find('tfoot td.sum_expenses div').html(Math.round(sum_expenses_number).toLocaleString('ru') + '  ₽').removeClass('animated-background');
      table.find('tfoot td.mid_expenses div').html(Math.round(mid_expenses).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      $(".table-full_stat tbody tr td.count_change").each(function() {

        var label = $(this).data('label');
        var val_cur = parseFloat($(this).text().trim().replace(/\s/g, "").replace(",", "."));
        var val_last = parseFloat($(this).parent('tr').next('tr').find('td[data-label="' + label + '"]').text().trim().replace(/\s/g, "").replace(",", "."));

        if (!isNaN(val_last)) {
          var diff = val_cur - val_last;
          var perc = Math.round( diff * 100 / val_last );

          if (perc < -20 || perc > 20) {

            if (diff > 0) {
              var marker = $('<div>').attr('class', 'label_table up').text(Math.abs(perc) + " %");
            } else {
              var marker = $('<div>').attr('class', 'label_table down').text(Math.abs(perc) + " %");
            }
            $(this).append(marker);

          }
        }

      });

      renderFullStatByDay();

    }

    function renderFullStatByDay() {

      var block_full_stat_by_day = $("#full-stat-by-day-chart");

      var options = {
        series: [
          {
            name: 'Приходы',
            type: 'area',
            data: incomes_data,
          },
          {
            name: 'Расходы',
            type: 'area',
            data: expenses_data,
          },
          {
            name: 'Обращения',
            type: 'column',
            data: requests_data,
          },
          {
            name: 'Заказы',
            type: 'column',
            data: orders_data,
          },
          {
            name: 'Прибыль',
            type: 'line',
            data: profit,
          },
          {
            name: 'Лид',
            type: 'line',
            data: lead_cost,
          },
        ],
        chart: {
          height: 500,
          type: 'line',
          stacked: false,
          toolbar:{
            show: false,
          },
          locales: [{
            "name": "ru",
            "options": {
              "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
              "shortMonths": ["Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
              "days": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
              "shortDays": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            }
          }],
          defaultLocale: "ru",
        },
        colors: ['#47A76A', '#FF2B2B', '#00E396', '#42AAFF', '#FEB019', '#775DD0'],
        stroke: {
          width: [1, 1, 1, 1, 6, 6],
          curve: 'smooth'
        },
        plotOptions: {
          bar: {
            columnWidth: '30%'
          }
        },
        fill: {
          type: 'gradient',
          opacity: [0.85, 0.25, 1],
          gradient: {
            shade: 'light',
            type: "vertical",
            shadeIntensity: 0.5,
            inverseColors: false,
            opacityFrom: .9,
            opacityTo: .9,
            stops: [0, 50, 100],
            colorStops: []
          },

        },
        markers: {
          size: 0
        },
        xaxis: {
          type: 'datetime',
          labels: {
            format: 'dd.MM ddd',
          },
        },
        yaxis: [
          {
            seriesName: 'Приходы',
            title: {
              text: "Сводный график",
            }
          },
          {
            seriesName: 'Приходы',
            show: false
          },
          {
            seriesName: 'Обращения',
            show: false
          },
          {
            seriesName: 'Обращения',
            show: false
          },
          {
            seriesName: 'Прибыль',
            show: false
          },
          {
            seriesName: 'Лид',
            show: false
          },
        ],
        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function (y) {
              if (typeof y !== "undefined") {
                if (y > 2000) return y.toLocaleString('ru') + " руб.";
                else return y.toFixed(0);
              }
              return y;
            }
          },
          x: {
            format: 'dddd dd.MM.yy'
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#full-stat-by-day-chart"), options);
        chart.render();
        block_full_stat_by_day.removeClass('animated-background');
    }

    function fillTableFullStatMonth(){

      var table = $(".table-full_stat_month");
      var sum_expenses_month = [];
      var sum_profit_month = [];
      var sum_lead_month = [];

      $.each(expenses_data_month, function(key,value) {

        var row_tr = table.find('input[value="' + value.x + '"]').closest('tr');
        var val = Math.round(value.y * 100) / 100;
        sum_expenses_month.push(val);

        var income = row_tr.find('td.incomes input').val();
        var orders = row_tr.find('td.orders input').val();

        var profit = income - value.y;
        sum_profit_month.push(profit);

        row_tr.find('td.expenses div').html(Math.round(val).toLocaleString('ru') + '  ₽').removeClass('animated-background');
        row_tr.find('td.profit div').html(Math.round(profit).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      });

      $.each(lead_cost_month, function(key,value) {

        var row_tr = table.find('input[value="' + value.x + '"]').closest('tr');

        var lead = parseInt(value.y);
        if (lead == Number.POSITIVE_INFINITY || lead == Number.NEGATIVE_INFINITY || lead > 70000) {
          lead = 0;
        }
        else {
          sum_lead_month.push(lead);
        }

        row_tr.find('td.lead_price div').html(Math.round(lead).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      });

      var mid_lead = Math.round(sum_lead_month.reduce((partialSum, a) => partialSum + a, 0) / sum_lead_month.length * 100) / 100;

      var sum_profit_number = sum_profit_month.reduce((partialSum, a) => partialSum + a, 0);
      var mid_profit = Math.round(sum_profit_number / sum_profit_month.length * 100) / 100;

      var sum_expenses_number = sum_expenses_month.reduce((partialSum, a) => partialSum + a, 0);
      var mid_expenses = Math.round(sum_expenses_number / sum_expenses_month.length * 100) / 100;

      table.find('tfoot td.lead_price div').html(Math.round(mid_lead).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      table.find('tfoot td.sum_profit div').html(Math.round(sum_profit_number).toLocaleString('ru') + '  ₽').removeClass('animated-background');
      table.find('tfoot td.mid_profit div').html(Math.round(mid_profit).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      table.find('tfoot td.sum_expenses div').html(Math.round(sum_expenses_number).toLocaleString('ru') + '  ₽').removeClass('animated-background');
      table.find('tfoot td.mid_expenses div').html(Math.round(mid_expenses).toLocaleString('ru') + '  ₽').removeClass('animated-background');

      $(".table-full_stat_month tbody tr td.count_change").each(function() {

        var label = $(this).data('label');
        var val_cur = parseFloat($(this).text().trim().replace(/\s/g, "").replace(",", "."));
        var val_last = parseFloat($(this).parent('tr').next('tr').find('td[data-label="' + label + '"]').text().trim().replace(/\s/g, "").replace(",", "."));

        if (!isNaN(val_last) && val_last != 0) {
          var diff = val_cur - val_last;
          var perc = Math.round( diff * 100 / val_last );

          if (perc < 0 || perc > 0) {

            if (perc < -1000 || perc > 1000) perc = 999;

            if (diff > 0) {
              var marker = $('<div>').attr('class', 'label_table up').text(Math.abs(perc) + " %");
            } else {
              var marker = $('<div>').attr('class', 'label_table down').text(Math.abs(perc) + " %");
            }
            $(this).append(marker);

          }
        }

      });

      renderFullStatByMonth();

    }

    function renderFullStatByMonth() {

      var block_full_stat_by_month = $("#full-stat-by-month-chart");

      var options = {
        series: [
          {
            name: 'Оборот',
            type: 'area',
            data: turn_data_month,
          },
          {
            name: 'Приходы',
            type: 'area',
            data: incomes_data_month,
          },
          {
            name: 'Расходы',
            type: 'area',
            data: expenses_data_month,
          },
          {
            name: 'Обращения',
            type: 'column',
            data: requests_data_month,
          },
          {
            name: 'Заказы',
            type: 'column',
            data: orders_data_month,
          },
          {
            name: 'Прибыль',
            type: 'line',
            data: profit_data_month,
          },
          {
            name: 'Лид',
            type: 'line',
            data: lead_cost_month,
          },

        ],
        chart: {
          height: 400,
          type: 'line',
          stacked: false,
          toolbar:{
            show: false,
          },
          locales: [{
            "name": "ru",
            "options": {
              "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
              "shortMonths": ["Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
              "days": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
              "shortDays": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            }
          }],
          defaultLocale: "ru",
        },
        colors: ['#775DD0', '#47A76A', '#FF2B2B', '#00E396', '#42AAFF', '#FEB019', '#49423D'],
        stroke: {
          width: [1, 1, 1, 1, 1, 6, 6],
          curve: 'smooth'
        },
        plotOptions: {
          bar: {
            columnWidth: '10%'
          }
        },
        fill: {
          type: 'gradient',
          opacity: [0.85, 0.25, 1],
          gradient: {
            shade: 'light',
            type: "vertical",
            shadeIntensity: 0.5,
            inverseColors: false,
            opacityFrom: .9,
            opacityTo: .9,
            stops: [0, 50, 100],
            colorStops: []
          },

        },
        markers: {
          size: 0
        },
        xaxis: {
          type: 'datetime',
          labels: {
            format: 'MMM yyyy',
          },
        },
        yaxis: [
          {
            seriesName: 'Приходы',
            title: {
              text: "Сводный график",
            }
          },
          {
            seriesName: 'Приходы',
            show: false
          },
          {
            seriesName: 'Приходы',
            show: false
          },
          {
            seriesName: 'Обращения',
            show: false
          },
          {
            seriesName: 'Обращения',
            show: false
          },
          {
            seriesName: 'Прибыль',
            show: false
          },
          {
            seriesName: 'Лиды',
            show: false
          },
        ],
        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function (y) {
              if (typeof y !== "undefined") {
                if (y > 2000) return y.toLocaleString('ru') + " руб.";
                else return y.toFixed(0);
              }
              return y;
            }
          },
          x: {
            format: 'MMM yyyy'
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#full-stat-by-month-chart"), options);
        chart.render();
        block_full_stat_by_month.removeClass('animated-background');
    }

    function fillChartIncomesExpenses(){

      var block_profits = $("#chart-apex-column-01");

      var options = {
        series: [
          {
            name: 'Приход',
            data: incomes_data
          },
          {
            name: 'Расход',
            data: expenses_data
          },
        ],
        colors: ['#47A76A', '#FF2B2B'],
        chart: {
          height: 365,
          toolbar:{
            show: false,
          },
          type: 'area',
          locales: [{
            "name": "ru",
            "options": {
              "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
              "shortMonths": ["Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
              "days": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
              "shortDays": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            }
          }],
          defaultLocale: "ru",
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2,
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "vertical",
            shadeIntensity: 0.5,
            inverseColors: false,
            opacityFrom: .9,
            opacityTo: .3,
            stops: [0, 50, 100],
            colorStops: []
          }
        },
        grid: {
          xaxis: {
              lines: {
                  show: false
              }
          },
          yaxis: {
              lines: {
                  show: true
              }
          }
        },
        yaxis: {
          labels: {
            offsetY:0,
          },
        },
        xaxis: {
          type: 'datetime',
          labels: {
            format: 'dd.MM ddd',
          },
        },
        tooltip: {
          x: {
            format: 'dddd dd.MM.yy'
          },
        },
      };

      var chart = new ApexCharts(document.querySelector("#chart-apex-column-01"), options);
      chart.render();

      block_profits.removeClass('animated-background');

    }


    function ordersRequestsRender() {

      var block_orders = $("#chart-apex-column-10");

      var options = {
        series: [
          {
            name: 'Обращения',
            type: 'bar',
            data: requests_data
          },
          {
            name: 'Заказы',
            type: 'bar',
            data: got_orders
          },
          {
            name: "Реализация",
            type: 'line',
            data: realizaciya
          },
          {
            name: "Приход",
            type: 'area',
            data: incomes_by_creation_data
          },
          {
            name: "Стоимость лида",
            type: 'line',
            data: lead_cost
          },
          {
            name: "Директ",
            type: 'area',
            data: direct_expenses
          },

        ],
        chart: {
          height: 400,
          type: 'line',
          stacked: false,
          toolbar:{
            show: false,
          },
          locales: [{
            "name": "ru",
            "options": {
              "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
              "shortMonths": ["Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
              "days": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
              "shortDays": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            }
          }],
          defaultLocale: "ru",
        },
        colors: ['#00e396', '#008ffb', '#808080', '#FCD975', '#FF7514', '#CCCCFF'],
        stroke: {
          width: [1, 1, 3, 1, 6, 1],
          curve: 'smooth'
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '40%',
            endingShape: 'rounded'
          },
        },
        fill: {
          opacity: 0.5
        },
        markers: {
          size: 0
        },
        xaxis: {
            type: 'datetime',
            labels: {
              format: 'dd.MM ddd',
            },
        },
        yaxis: [
          {
            seriesName: 'Обращения',
            title: {
              text: "Сводный график",
            }
          },
          {
            seriesName: 'Обращения',
            show: false
          },
          {
            seriesName: 'Реализация',
            show: false
          },
          {
            seriesName: 'Директ',
            show: false
          },
          {
            seriesName: 'Стоимость лида',
            show: false
          },
          {
            seriesName: 'Директ',
            show: false
          },
        ],

        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function (y, context) {

              if (typeof y !== "undefined") {

                if (context.seriesIndex == 3 || context.seriesIndex == 4 || context.seriesIndex == 5) {
                  return y.toLocaleString('ru') + " руб.";
                }
                else if (context.seriesIndex == 2) {
                  return y + "%";
                }
                else {
                  return y.toFixed(0);
                }

              }

            }
          },
          x: {
            format: 'dddd dd.MM.yy'
          },
        },

        legend: {
          show: true,
          position: "top",
          horizontalAlign: "center",
          fontSize: '16px',
          markers: {
            width: 15,
            height: 15,
            radius: 2,
            offsetX: -3,
            offsetY: -1,
          },
          itemMargin: {
            horizontal: 8,
          },
          onItemClick: {
            toggleDataSeries: true
          },
          onItemHover: {
            highlightDataSeries: true
          },
        },



      };

      var chart = new ApexCharts(document.querySelector("#chart-apex-column-10"), options);
      chart.render();

      block_orders.removeClass('animated-background');

    }

    if(jQuery("#chart-apex-column-11").length){

      var block_orders_by_hours = $("#chart-apex-column-11");

      // $.ajax({
      //     url: '/get-data.php',
      //     type: 'POST',
      //     async: true,
      //     data: {
      //         action: "getTypeOrdersByHours",
      //         date_start: date_start,
      //         date_finish: date_finish
      //     },
      //     success: function(data) {
      //         orders_by_hour = Object.values($.parseJSON(data));
      //         renderChat();
      //     },
      // });

      function renderChat(){

          var options = {
            series: [
              {
                name: 'Заказов',
                data: orders_by_hour
              }
            ],
          chart: {
            type: 'bar',
            height: 350,
            stacked: false,
            toolbar: {
              show: false
            }
          },
          plotOptions: {
            bar: {
              horizontal: false,
              borderRadius: 10,
              dataLabels: {
                orientation: 'horizontal',
                total: {
                  enabled: false
                }
              }
            },
          },
          xaxis: {
            type: 'time',

          },
          fill: {
            opacity: 1
          },
          responsive: [
            {
              breakpoint: 750,
              options: {

                plotOptions: {
                  bar: {
                    borderRadius: 6,
                    columnWidth: '90%',
                    dataLabels: {
                      orientation: 'vertical',
                      total: {
                        style: {
                          color: '#000000',
                        }
                      }
                    }

                  }

                },

              },
            }
          ],
        };

        var chart = new ApexCharts(document.querySelector("#chart-apex-column-11"), options);
        chart.render();

        block_orders_by_hours.removeClass('animated-background');

      }

    }

    function profit_render() {

      var block_profit = $("#chart-apex-column-profit");

      if (block_profit.length) {

        var options = {
          series: [{
            name: 'Чистая прибыль',
            data: profit
          }],
          chart: {
            type: 'bar',
            height: 350,
            toolbar:{
              show: false,
            },
            locales: [{
              "name": "ru",
              "options": {
                "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                "shortMonths": ["Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                "days": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
                "shortDays": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
              }
            }],
            defaultLocale: "ru",
          },
          plotOptions: {
            bar: {
              colors: {
                ranges: [
                  {
                    from: -1000000,
                    to: -50000,
                    color: '#931B10'
                  },
                  {
                    from: -50001,
                    to: -20000,
                    color: '#FD5454'
                  },
                  {
                    from: -20001,
                    to: 0,
                    color: '#F1810B'
                  },
                  {
                    from: 1,
                    to: 20000,
                    color: '#F1DF07'
                  },
                  {
                    from: 20001,
                    to: 50000,
                    color: '#18DF29'
                  },
                  {
                    from: 50001,
                    to: 1000000,
                    color: '#4E8E07'
                  }
                ]
              },
              columnWidth: '80%',
            }
          },
          dataLabels: {
            enabled: false,
          },
          yaxis: {
            labels: {
              formatter: function (y) {
                return y.toFixed(0) + " руб.";
              }
            }
          },
          xaxis: {
            type: 'datetime',
            labels: {
              format: 'dd.MM ddd',
            },
          },
          tooltip: {
            x: {
              format: 'dddd dd.MM.yy'
            },
          },

        };

        var chart = new ApexCharts(document.querySelector("#chart-apex-column-profit"), options);
        chart.render();

        block_profit.removeClass('animated-background');
      }
    }




    function countMonthProfit(){
      profit_data_month = JSON.parse(JSON.stringify(expenses_data_month));

      $.each(profit_data_month, function(key,value) {
        var ind = Object.entries(incomes_data_month).find( (element) => element[1].x === value['x'] );

        if (typeof ind !== 'undefined') {
          profit_data_month[key].y = String( Math.round( parseFloat(incomes_data_month[ind[0]].y) - parseFloat(value['y']) ) * 100 / 100 );
        }
        else {
          profit_data_month[key].y = String( - parseFloat(value['y']) );
        }
      });

      check_datas();

    }


    function countProfit(){

      profit = JSON.parse(JSON.stringify(expenses_data));

      $.each(profit, function(key,value) {
        var ind = Object.entries(incomes_data).find( (element) => element[1].x === value['x'] );

        if (typeof ind !== 'undefined') {
          profit[key].y = String( Math.round( parseFloat(incomes_data[ind[0]].y) - parseFloat(value['y']) ) * 100 / 100 );
        }
        else {
          profit[key].y = String( - parseFloat(value['y']) );
        }
      });

      check_datas();

    }


    function countMonthLead(){

      if (direct_expenses_month.length > 0 && got_orders_month.length > 0) {

        $.each(direct_expenses_month, function(key,value) {

          var orders = Object.entries(got_orders_month).find( (element) => element[1].x === value['x'] );

          if (typeof orders !== 'undefined') {
            lead_cost_month.push({x:value.x, y: String( Math.round( value.y / orders[1].y ) * 100 / 100 ) });
          }
        });

        check_datas();

      }

    }

    function countLead(){

      if (direct_expenses.length > 0 && got_orders.length > 0) {

        $.each(direct_expenses, function(key,value) {

          var orders = Object.entries(got_orders).find( (element) => element[1].x === value['x'] );

          if (typeof orders !== 'undefined') {

            if (orders[1].y > 0) {
              lead_cost.push({x:value.x, y: String(  Math.round( value.y / orders[1].y ) * 100 / 100 ) });
            }

          }
          else {
            lead_cost.push({x:value.x, y: String(0) });
          }

        });

        check_datas();

      }

    }

    function countRealizaciya(){

      if (requests_data.length > 0 && got_orders.length > 0) {

        $.each(requests_data, function(key,value) {
          var ordersReal = Object.entries(got_orders).find( (element) => element[1].x === value['x'] );

          if (typeof ordersReal !== 'undefined') {

            if (ordersReal[1].y > 0) {
              realizaciya.push({x:value.x, y: String(  Math.round(ordersReal[1].y * 100 / value.y) ) });
            }

          } else {
            realizaciya.push({x:value.x, y: String(0) });
          }

        });

        check_datas();
      }

    }

    // if(jQuery("#ct-chart").length){
      // new Chartist.Bar('#ct-chart', {
      //   labels: ['Q1', 'Q2', 'Q3', 'Q4'],
      //   series: [
      //     [800, 1200, 1400, 1300],
      //     [200, 400, 500, 300],
      //     [100, 200, 400, 600]
      //     ]
      // }, {
      //   stackBars: true,
      //   axisY: {
      //     labelInterpolationFnc: function(value) {
      //       return (value / 1000) + 'k';
      //     }
      //   }
      // }).on('draw', function(data) {
      //   if(data.type === 'bar') {
      //     data.element.attr({
      //       style: 'stroke-width: 40px'
      //     });
      //   }
      // });
    //   var options = {
    //     series: [{
    //     data: [21, 22, 10, 28, 16, 21, 13, 30]
    //   }],
    //   colors: ['#5c00e6', '#5c00e6', '#004d99', '#0044cc', '#5c00e6', '#004d99', '#0044cc', '#5c00e6'],
    //     chart: {
    //       sparkline: {
    //         enabled: true,
    //     },
    //     height: 250,
    //     type: 'bar',
    //     events: {
    //       click: function(chart, w, e) {
    //         // console.log(chart, w, e)
    //       }
    //     }
    //   },
    //   plotOptions: {
    //     bar: {
    //       columnWidth: '45%',
    //       distributed: true,
    //     }
    //   },
    //   dataLabels: {
    //     enabled: false
    //   },
    //   legend: {
    //     show: false
    //   },
    //   xaxis: {
    //     categories: [
    //       'C',
    //       'C++',
    //       'Java',
    //       'C#',
    //       'Python',
    //       'NodeJS',
    //       'AnglarJS',
    //       'AI'
    //     ],
    //     labels: {
    //       style: {
    //         fontSize: '12px'
    //       }
    //     }
    //   }
    //   };

    //   var chart = new ApexCharts(document.querySelector("#ct-chart"), options);
    //   chart.render();
    // }

    // if(jQuery("#chart-column-01").length){
    //   var options = {
    //     series: [{
    //     name: 'TEAM A',
    //     type: 'column',
    //     data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
    //   }, {
    //     name: 'TEAM B',
    //     type: 'area',
    //     data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
    //   }, {
    //     name: 'TEAM C',
    //     type: 'line',
    //     data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
    //   }],
    //   colors: ['#5c00e6', '#ffff33', '#04237D'],
    //     chart: {
    //     height: 240,
    //     type: 'line',
    //     stacked: false,
    //       sparkline: {
    //         enabled: true,
    //     }
    //   },
    //   stroke: {
    //     width: [0, 2, 5],
    //     curve: 'smooth'
    //   },
    //   plotOptions: {
    //     bar: {
    //       columnWidth: '50%'
    //     }
    //   },

    //   fill: {
    //     opacity: [0.85, 0.25, 1],
    //     gradient: {
    //       inverseColors: false,
    //       shade: 'light',
    //       type: "vertical",
    //       opacityFrom: 0.85,
    //       opacityTo: 0.55,
    //       stops: [0, 100, 100, 100]
    //     }
    //   },
    //   labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
    //     '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
    //   ],
    //   markers: {
    //     size: 0
    //   },
    //   xaxis: {
    //     type: 'datetime'
    //   },
    //   yaxis: {
    //     title: {
    //       text: 'Points',
    //     },
    //     min: 0
    //   },
    //   tooltip: {
    //     shared: true,
    //     intersect: false,
    //     y: {
    //       formatter: function (y) {
    //         if (typeof y !== "undefined") {
    //           return y.toFixed(0) + " points";
    //         }
    //         return y;

    //       }
    //     }
    //   }
    //   };

    //   var chart = new ApexCharts(document.querySelector("#chart-column-01"), options);
    //   chart.render();
    // }

    // if (jQuery("#chart-01").length) {
    //     var options = {
    //       series: [{
    //         name: 'Successful deals',
    //         data: [60, 30, 60, 30, 60, 30, 60]
    //       }, {
    //         name: 'Failed deals',
    //         data: [30, 60, 30, 60, 30, 60, 30]
    //       }],
    //       colors: ["#4788ff", "#f75676"],
    //       chart: {
    //         height: 370,
    //         type: 'line',
    //         zoom: {
    //           enabled: false
    //         },
    //         sparkline: {
    //           enabled: false,
    //         }
    //       },
    //       dataLabels: {
    //         enabled: false
    //       },
    //       stroke: {
    //         curve: 'smooth',
    //         width: 3
    //       },
    //       title: {
    //         text: '',
    //         align: 'left'
    //       },
    //       grid: {
    //         row: {
    //           colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
    //           opacity: 0
    //         },
    //       },
    //       xaxis: {
    //         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    //         labels: {
    //              minHeight: 22,
    //             maxHeight: 35,
    //          }
    //       },
    //       yaxis: {
    //         labels: {
    //             offsetY: 0,
    //             minWidth: 15,
    //             maxWidth: 15,
    //           }
    //        },
    //        legend: {
    //         position: 'top',
    //         horizontalAlign: 'left',
    //         offsetX: -33
    //       }
    //     };

    //     var chart = new ApexCharts(document.querySelector("#chart-01"), options);
    //     chart.render();
    //     const body = document.querySelector('body')
    //     if (body.classList.contains('dark')) {
    //       apexChartUpdate(chart, {
    //         dark: true
    //       })
    //     }

    //     document.addEventListener('ChangeColorMode', function (e) {
    //       apexChartUpdate(chart, e.detail)
    //     })

    //   }

    // if (jQuery("#dash-chart-03").length) {
    //     const options = {
    //       series: [{
    //         name: 'Revenue',
    //         data: [76, 85, 101, 98, 87, 105, 91]
    //       }, {
    //           name: 'Net Profit',
    //           data: [44, 55, 57, 56, 61, 58, 63]
    //         }],
    //       chart: {
    //         type: 'bar',
    //         height: 260
    //       },
    //       colors: ['#4788ff', '#37d5f2'],
    //       plotOptions: {
    //         bar: {
    //           horizontal: false,
    //           // columnWidth: '45%',
    //           borderRadius: 4,
    //         },
    //       },
    //       dataLabels: {
    //         enabled: false
    //       },
    //       legend: {
    //         show: false
    //       },
    //       stroke: {
    //         show: true,
    //         width: 2,
    //         colors: ['transparent']
    //       },
    //       xaxis: {
    //         categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    //         labels:{
    //           minHeight: 30,
    //           maxHeight: 30,
    //         }
    //       },
    //       yaxis: {
    //         title: {

    //         },
    //         labels: {
    //           offsetY: 0,
    //           minWidth: 15,
    //           maxWidth: 15,
    //         }
    //       },
    //       fill: {
    //         opacity: 1
    //       },
    //       tooltip: {
    //         y: {
    //           formatter: function (val) {
    //             return "$ " + val + " thousands"
    //           }
    //         }
    //       }
    //     };

    //     const chart = new ApexCharts(document.querySelector("#dash-chart-03"), options);
    //     chart.render();
    //     const body = document.querySelector('body')
    //     if (body.classList.contains('dark')) {
    //       apexChartUpdate(chart, {
    //         dark: true
    //       })
    //     }

    //     document.addEventListener('ChangeColorMode', function (e) {
    //       apexChartUpdate(chart, e.detail)
    //     })
    //   }

    //   if (jQuery("#dash-chart-02").length) {
    //     const options = {
    //       series: [
    //         {
    //           name: 'Like',
    //           data: [50, 25, 10, 70, 25, 30, 25]
    //         },
    //         {
    //           name: 'Comments',
    //           data: [50, 25, 10, 70, 25, 30, 25]
    //         },
    //         {
    //           name: 'Share',
    //           data: [60, 44, 20, 35, 22, 22, 10]
    //         }
    //       ],
    //       colors: ['#37d5f2', '#4788ff', '#4fd69c'],
    //       chart: {
    //         type: 'bar',
    //         height: 275,
    //         stacked: true,
    //         zoom: {
    //           enabled: true
    //         }
    //       },
    //       options: {
    //         legend: {
    //           markers: {
    //             radius: 12,
    //           }
    //         }
    //       },

    //       responsive: [{
    //         breakpoint: 480,
    //         options: {
    //           legend: {
    //             position: 'bottom',
    //             offsetX: -10,
    //             offsetY: 0,

    //           }
    //         }
    //       }],
    //       plotOptions: {
    //         bar: {
    //           horizontal: false,
    //           // columnWidth: '45%',
    //           borderRadius: 4,
    //         },
    //       },
    //       xaxis: {
    //         type: 'category',
    //         categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    //         labels: {
    //             minHeight: 22,
    //             maxHeight: 40,
    //          }
    //       },
    //       yaxis: {
    //         labels: {
    //             // offsetX: -17,
    //             offsetY: 0,
    //             minWidth: 20,
    //             maxWidth: 20,
    //           }
    //        },
    //       legend: {
    //         position: 'bottom',
    //         offsetX: 0,
    //         offsetY: 8

    //       },
    //       fill: {
    //         opacity: 1
    //       },
    //       dataLabels: {
    //         enabled: false
    //       }
    //     };
    //     const chart = new ApexCharts(document.querySelector("#dash-chart-02"), options);
    //     chart.render();
    //     const body = document.querySelector('body')
    //     if (body.classList.contains('dark')) {
    //       apexChartUpdate(chart, {
    //         dark: true
    //       })
    //     }

    //     document.addEventListener('ChangeColorMode', function (e) {
    //       apexChartUpdate(chart, e.detail)
    //     })
    //   }




      // if(jQuery("#chart-apex-column-02").length){
      //   var options = {
      //     series: [{
      //     data: [55, 42, 19, 30, 20, 65, 21, 23, 45, 60, 30, 20]
      //   }],
      //   colors: ['#b3cccc', '#04237D', '#4d4dff'],
      //     chart: {
      //     height: 183,
      //     type: 'bar',
      //     toolbar:{
      //       show: false,
      //     },
      //     sparkline: {
      //       enabled: true,
      //     },
      //     events: {
      //       click: function(chart, w, e) {
      //         // console.log(chart, w, e)
      //       }
      //     }
      //   },
      //   plotOptions: {
      //     bar: {
      //       columnWidth: '40%',
      //       distributed: true,
      //       borderRadius: 5,
      //     }
      //   },
      //   dataLabels: {
      //     enabled: false
      //   },
      //   legend: {
      //     show: false
      //   },
      //   grid: {
      //     xaxis: {
      //         lines: {
      //             show: false
      //         }
      //     },
      //     yaxis: {
      //         lines: {
      //             show: false
      //         }
      //     }
      //   },
      //   yaxis: {
      //     labels: {
      //     offsetY:0,
      //     minWidth: 10,
      //     maxWidth: 10
      //     },
      //   },

      //   xaxis: {
      //     categories: [
      //       '30 Jan',
      //       '25 Feb',
      //       '28 Mar',
      //     ],
      //     labels: {
      //       minHeight: 20,
      //       maxHeight: 20,
      //       style: {
      //         fontSize: '12px'
      //       }
      //     }
      //   }
      //   };

      //   var chart = new ApexCharts(document.querySelector("#chart-apex-column-02"), options);
      //   chart.render();
      // }

      // if(jQuery("#chart-apex-column-03").length){
      //     var options = {
      //       series: [43,58,20,35],
      //       chart: {
      //       height:330,
      //       type: 'donut',

      //     },

      //     labels: ["Mobile","Electronics", "Laptop", "Others"],
      //     colors: ['#ffbb33', '#04237D', '#e60000', '#8080ff'],
      //     plotOptions: {
      //       pie: {
      //         startAngle: -90,
      //         endAngle: 270,
      //         donut:{
      //           size: '80%',
      //           labels:{
      //             show:true,
      //             total:{
      //               show:true,
      //               color: '#BCC1C8',
      //               fontSize: '18px',
      //               fontFamily: 'DM Sans',
      //               fontWeight: 600,
      //             },
      //             value: {
      //               show: true,
      //               fontSize: '25px',
      //               fontFamily: 'DM Sans',
      //               fontWeight: 700,
      //               color: '#8F9FBC',
      //             },
      //           }
      //         }
      //       }
      //     },
      //     dataLabels: {
      //       enabled: false,
      //     },
      //     stroke: {
      //       lineCap: 'round'
      //     },
      //     grid:{
      //       padding: {

      //         bottom: 0,
      //     }
      //     },
      //     legend: {
      //       position: 'bottom',
      //       offsetY: 8,
      //       show:true,
      //     },
      //     responsive: [{
      //       breakpoint: 480,
      //       options: {
      //         chart: {
      //           height:268
      //         }
      //       }
      //     }]
      //     };

      //     var chart = new ApexCharts(document.querySelector("#chart-apex-column-03"), options);
      //     chart.render();

      //     const body = document.querySelector('body')
      //     if (body.classList.contains('dark')) {
      //       apexChartUpdate(chart, {
      //         dark: true
      //       })
      //     }

      //     document.addEventListener('ChangeColorMode', function (e) {
      //       apexChartUpdate(chart, e.detail)
      //     })
      // }



      // if(jQuery("#chart-map-column-04").length){
      //   var LabeledMarker = require('leaflet-labeled-circle');
      //   const map = L.map('chart-map-column-04').setView([55.75222, 37.61556], 8);

      //   const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
      //   const attribution =
      //   '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
      //   const tileLayer = L.tileLayer(tileUrl, { attribution });

      //   var feature = {
      //     "type": "Feature",
      //     "properties": {
      //       "text": "122 sadsa",
      //       "labelPosition": [55.75222, 37.61556]
      //     },
      //     "geometry": {
      //       "type": "Point",
      //       "coordinates": [55.75222, 37.61556]
      //     }
      //   };

      //   tileLayer.addTo(map);

      //   var marker = new LabeledMarker(
      //     feature.geometry.coordinates.slice().reverse(),
      //     feature, {
      //       markerOptions: { color: '#050' }
      //     }
      //   ).addTo(map);

        // var circle = L.circle([55.75222, 37.61556], {
        //   color: 'red',
        //   fillColor: '#f03',
        //   fillOpacity: 0.5,
        //   html: '500 heff',
        //   radius: 10000
        // }).addTo(map);

      // }

      // if(jQuery("#chart-apex-column-001").length){
      //   var options = {
      //     series: [{
      //     data: [91, 82, 90, 88, 105, 99]
      //   }],
      //     chart: {
      //     height: 265,
      //     type: 'bar',
      //     toolbar:{
      //       show: false,
      //     },
      //     events: {
      //       click: function(chart, w, e) {
      //         // console.log(chart, w, e)
      //       }
      //     }
      //   },
      //   plotOptions: {
      //     bar: {
      //       columnWidth: '35%',
      //       distributed: true,
      //     }
      //   },
      //   dataLabels: {
      //     enabled: false
      //   },
      //   grid: {
      //     xaxis: {
      //         lines: {
      //             show: false
      //         }
      //     },
      //     yaxis: {
      //         lines: {
      //             show: true
      //         }
      //     }
      //   },
      //   legend: {
      //     show: false
      //   },
      //   yaxis: {
      //     labels: {
      //     offsetY:0,
      //     minWidth: 20,
      //     maxWidth: 20
      //     },
      //   },
      //   xaxis: {
      //     categories: [
      //       'Jan',
      //       'Feb',
      //       'Mar',
      //       'Apr',
      //       'May',
      //       'June',
      //     ],
      //     labels: {
      //       minHeight: 22,
      //       maxHeight: 22,
      //       style: {
      //         fontSize: '12px'
      //       }
      //     }
      //   }
      //   };

      //   var chart = new ApexCharts(document.querySelector("#chart-apex-column-001"), options);
      //   chart.render();
      // }

    function generateData(baseval, count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
          //var x =Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
          var y = Math.floor(Math.random() * (yrange.max + yrange.min + 1)) + yrange.min;
          var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

          series.push([baseval, y, z]);
          baseval += 86400000;
          i++;
        }
        return series;
      }

      function apexChartUpdate(chart, detail) {
          let color = getComputedStyle(document.documentElement).getPropertyValue('--dark');
          if (detail.dark) {
            color = getComputedStyle(document.documentElement).getPropertyValue('--white');
          }
        console.log(chart,detail)
          chart.updateOptions({
            chart: {
              foreColor: color
            }
          })
      }

      function dateRange(startDate, endDate, steps = 1) {
        const dateArray = [];
        let currentDate = new Date(startDate);

        while (currentDate <= new Date(endDate)) {
          var d = new Date(currentDate);
          dateArray.push(d.getFullYear()  + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2));
          currentDate.setUTCDate(currentDate.getUTCDate() + steps);
        }

        return dateArray;
      }

})(jQuery)
