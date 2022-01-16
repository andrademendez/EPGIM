(function () {
    isWindows = navigator.platform.indexOf("Win") > -1 ? true : false;

    if (isWindows) {
        // if we are on windows OS we activate the perfectScrollbar function
        $(".sidebar .sidebar-wrapper, .main-panel").perfectScrollbar();

        $("html").addClass("perfect-scrollbar-on");
    } else {
        $("html").addClass("perfect-scrollbar-off");
    }
})();

var breakCards = true;

var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var mobile_menu_visible = 0,
    mobile_menu_initialized = false,
    toggle_initialized = false,
    bootstrap_nav_initialized = false;

var seq = 0,
    delays = 80,
    durations = 500;
var seq2 = 0,
    delays2 = 80,
    durations2 = 500;

$(document).ready(function () {
    $sidebar = $(".sidebar");
    window_width = $(window).width();

    $("body").bootstrapMaterialDesign({
        autofill: false,
    });

    md.initSidebarsCheck();

    window_width = $(window).width();

    // check if there is an image set for the sidebar's background
    md.checkSidebarImage();

    md.initMinimizeSidebar();

    // Multilevel Dropdown menu

    $(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        if (!$(this).next().hasClass("show")) {
            $(this)
                .parents(".dropdown-menu")
                .first()
                .find(".show")
                .removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass("show");

        $(this).closest("a").toggleClass("open");

        $(this)
            .parents("a.dropdown-item.dropdown.show")
            .on("hidden.bs.dropdown", function (e) {
                $(".dropdown-menu .show").removeClass("show");
            });

        if (!$parent.parent().hasClass("navbar-nav")) {
            $el.next().css({
                top: $el[0].offsetTop,
                left: $parent.outerWidth() - 4,
            });
        }

        return false;
    });

    //   Activate bootstrap-select
    if ($(".selectpicker").length != 0) {
        $(".selectpicker").selectpicker();
    }

    //  Activate the tooltips
    $('[rel="tooltip"]').tooltip();

    // Activate Popovers
    $('[data-toggle="popover"]').popover();

    //Activate tags
    // we style the badges with our colors
    var tagClass = $(".tagsinput").data("color");

    if ($(".tagsinput").length != 0) {
        $(".tagsinput").tagsinput();
    }

    $(".bootstrap-tagsinput").addClass("" + tagClass + "-badge");

    //    Activate bootstrap-select
    $(".select").dropdown({
        dropdownClass: "dropdown-menu",
        optionClass: "",
    });

    $(".form-control")
        .on("focus", function () {
            $(this).parent(".input-group").addClass("input-group-focus");
        })
        .on("blur", function () {
            $(this).parent(".input-group").removeClass("input-group-focus");
        });

    if (breakCards == true) {
        // We break the cards headers if there is too much stress on them :-)
        $('[data-header-animation="true"]').each(function () {
            var $fix_button = $(this);
            var $card = $(this).parent(".card");

            $card.find(".fix-broken-card").click(function () {
                console.log(this);
                var $header = $(this)
                    .parent()
                    .parent()
                    .siblings(".card-header, .card-header-image");

                $header.removeClass("hinge").addClass("fadeInDown");

                $card.attr("data-count", 0);

                setTimeout(function () {
                    $header.removeClass("fadeInDown animate");
                }, 480);
            });

            $card.mouseenter(function () {
                var $this = $(this);
                hover_count = parseInt($this.attr("data-count"), 10) + 1 || 0;
                $this.attr("data-count", hover_count);

                if (hover_count >= 20) {
                    $(this)
                        .children(".card-header, .card-header-image")
                        .addClass("hinge animated");
                }
            });
        });
    }

    // remove class has-error for checkbox validation
    $(
        'input[type="checkbox"][required="true"], input[type="radio"][required="true"]'
    ).on("click", function () {
        if ($(this).hasClass("error")) {
            $(this).closest("div").removeClass("has-error");
        }
    });
});

$(document).on("click", ".navbar-toggler", function () {
    $toggle = $(this);

    if (mobile_menu_visible == 1) {
        $("html").removeClass("nav-open");

        $(".close-layer").remove();
        setTimeout(function () {
            $toggle.removeClass("toggled");
        }, 400);

        mobile_menu_visible = 0;
    } else {
        setTimeout(function () {
            $toggle.addClass("toggled");
        }, 430);

        var $layer = $('<div class="close-layer"></div>');

        if ($("body").find(".main-panel").length != 0) {
            $layer.appendTo(".main-panel");
        } else if ($("body").hasClass("off-canvas-sidebar")) {
            $layer.appendTo(".wrapper-full-page");
        }

        setTimeout(function () {
            $layer.addClass("visible");
        }, 100);

        $layer.click(function () {
            $("html").removeClass("nav-open");
            mobile_menu_visible = 0;

            $layer.removeClass("visible");

            setTimeout(function () {
                $layer.remove();
                $toggle.removeClass("toggled");
            }, 400);
        });

        $("html").addClass("nav-open");
        mobile_menu_visible = 1;
    }
});

// activate collapse right menu when the windows is resized
$(window).resize(function () {
    md.initSidebarsCheck();

    // reset the seq for charts drawing animations
    seq = seq2 = 0;

    setTimeout(function () {
        md.initDashboardPageCharts();
    }, 500);
});

md = {
    misc: {
        navbar_menu_visible: 0,
        active_collapse: true,
        disabled_collapse_init: 0,
    },

    checkSidebarImage: function () {
        $sidebar = $(".sidebar");
        image_src = $sidebar.data("image");

        if (image_src !== undefined) {
            sidebar_container =
                '<div class="sidebar-background" style="background-image: url(' +
                image_src +
                ') "/>';
            $sidebar.append(sidebar_container);
        }
    },

    showNotification: function (from, align) {
        type = ["", "info", "danger", "success", "warning", "rose", "primary"];

        color = Math.floor(Math.random() * 6 + 1);

        $.notify(
            {
                icon: "add_alert",
                message:
                    "Welcome to <b>Material Dashboard Pro</b> - a beautiful admin panel for every web developer.",
            },
            {
                type: type[color],
                timer: 3000,
                placement: {
                    from: from,
                    align: align,
                },
            }
        );
    },

    initDocumentationCharts: function () {
        if (
            $("#estatusConfirmado").length != 0 &&
            $("#estatusHolds").length != 0
        ) {
            /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

            dataestatusConfirmado = {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                series: [[12, 17, 7, 17, 23, 18, 38]],
            };

            optionsestatusConfirmado = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0,
                }),
                low: 0,
                high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0,
                },
            };

            var estatusConfirmado = new Chartist.Line(
                "#estatusConfirmado",
                dataestatusConfirmado,
                optionsestatusConfirmado
            );

            var animationHeaderChart = new Chartist.Line(
                "#estatusHolds",
                dataestatusConfirmado,
                optionsestatusConfirmado
            );
        }
    },

    initFormExtendedDatetimepickers: function () {
        $(".datetimepicker").datetimepicker({
            // locale: 'ES',
            format: "DD-MMM-YYYY hh:mm:ss",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
                today: "fa fa-screenshot",
                clear: "fa fa-trash",
                close: "fa fa-remove",
            },
        });

        $(".datepicker").datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
                today: "fa fa-screenshot",
                clear: "fa fa-trash",
                close: "fa fa-remove",
            },
            format: "DD-MMM-YYYY",
        });

        $(".timepicker").datetimepicker({
            //          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: "hh:mm:ss", //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
                today: "fa fa-screenshot",
                clear: "fa fa-trash",
                close: "fa fa-remove",
            },
        });
    },

    initSliders: function () {
        // Sliders for demo purpose
        var slider = document.getElementById("sliderRegular");

        noUiSlider.create(slider, {
            start: 40,
            connect: [true, false],
            range: {
                min: 0,
                max: 100,
            },
        });

        var slider2 = document.getElementById("sliderDouble");

        noUiSlider.create(slider2, {
            start: [20, 60],
            connect: true,
            range: {
                min: 0,
                max: 100,
            },
        });
    },

    initSidebarsCheck: function () {
        if ($(window).width() <= 991) {
            if ($sidebar.length != 0) {
                md.initRightMenu();
            }
        }
    },

    checkFullPageBackgroundImage: function () {
        $page = $(".full-page");
        image_src = $page.data("image");

        if (image_src !== undefined) {
            image_container =
                '<div class="full-page-background" style="background-image: url(' +
                image_src +
                ') "/>';
            $page.append(image_container);
        }
    },

    initDashboardPageCharts: function () {
        if (
            $("#estatusConfirmado").length != 0 ||
            $("#statusCompleted").length != 0 ||
            $("#estatusHols").length != 0
        ) {
            /* ----------==========     Daily Sales Chart initialization    ==========---------- */

            dataestatusConfirmado = {
                labels: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                series: [[6, 10, 4, 17, 8, 9, 5, 8, 9, 5, 8, 9]],
            };

            optionsestatusConfirmado = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0,
                }),
                low: 0,
                high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0,
                },
            };

            var estatusConfirmado = new Chartist.Line(
                "#estatusConfirmado",
                dataestatusConfirmado,
                optionsestatusConfirmado
            );

            md.startAnimationForLineChart(estatusConfirmado);

            /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

            datastatusCompleted = {
                labels: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                series: [[6, 10, 4, 17, 8, 9, 5, 8, 9, 5, 8, 9]],
            };

            optionsstatusCompleted = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0,
                }),
                low: 0,
                high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0,
                },
            };

            var statusCompleted = new Chartist.Line(
                "#statusCompleted",
                datastatusCompleted,
                optionsstatusCompleted
            );

            // start animation for the Completed Tasks Chart - Line Chart
            md.startAnimationForLineChart(statusCompleted);

            /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

            var dataestatusHolds = {
                labels: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                series: [[6, 10, 4, 17, 8, 9, 5, 8, 9, 5, 8, 9]],
            };
            var optionsestatusHolds = {
                axisX: {
                    showGrid: false,
                },
                low: 0,
                high: 50,
                chartPadding: {
                    top: 0,
                    right: 5,
                    bottom: 0,
                    left: 0,
                },
            };
            var responsiveOptions = [
                [
                    "screen and (max-width: 640px)",
                    {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                return value[0];
                            },
                        },
                    },
                ],
            ];
            var estatusHolds = Chartist.Line(
                "#estatusHols",
                dataestatusHolds,
                optionsestatusHolds,
                responsiveOptions
            );

            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(estatusHolds);
        }
    },

    initMinimizeSidebar: function () {
        $("#minimizeSidebar").click(function () {
            var $btn = $(this);

            if (md.misc.sidebar_mini_active == true) {
                $("body").removeClass("sidebar-mini");
                md.misc.sidebar_mini_active = false;
            } else {
                $("body").addClass("sidebar-mini");
                md.misc.sidebar_mini_active = true;
            }

            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function () {
                window.dispatchEvent(new Event("resize"));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function () {
                clearInterval(simulateWindowResize);
            }, 1000);
        });
    },

    checkScrollForTransparentNavbar: debounce(function () {
        if ($(document).scrollTop() > 260) {
            if (transparent) {
                transparent = false;
                $(".navbar-color-on-scroll").removeClass("navbar-transparent");
            }
        } else {
            if (!transparent) {
                transparent = true;
                $(".navbar-color-on-scroll").addClass("navbar-transparent");
            }
        }
    }, 17),

    initRightMenu: debounce(function () {
        $sidebar_wrapper = $(".sidebar-wrapper");

        if (!mobile_menu_initialized) {
            $navbar = $("nav").find(".navbar-collapse").children(".navbar-nav");

            mobile_menu_content = "";

            nav_content = $navbar.html();

            nav_content =
                '<ul class="nav navbar-nav nav-mobile-menu">' +
                nav_content +
                "</ul>";

            navbar_form = $("nav").find(".navbar-form").get(0).outerHTML;

            $sidebar_nav = $sidebar_wrapper.find(" > .nav");

            // insert the navbar form before the sidebar list
            $nav_content = $(nav_content);
            $navbar_form = $(navbar_form);
            $nav_content.insertBefore($sidebar_nav);
            $navbar_form.insertBefore($nav_content);

            $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(
                function (event) {
                    event.stopPropagation();
                }
            );

            // simulate resize so all the charts/maps will be redrawn
            window.dispatchEvent(new Event("resize"));

            mobile_menu_initialized = true;
        } else {
            if ($(window).width() > 991) {
                // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
                $sidebar_wrapper.find(".navbar-form").remove();
                $sidebar_wrapper.find(".nav-mobile-menu").remove();

                mobile_menu_initialized = false;
            }
        }
    }, 200),

    startAnimationForLineChart: function (chart) {
        chart.on("draw", function (data) {
            if (data.type === "line" || data.type === "area") {
                data.element.animate({
                    d: {
                        begin: 600,
                        dur: 700,
                        from: data.path
                            .clone()
                            .scale(1, 0)
                            .translate(0, data.chartRect.height())
                            .stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint,
                    },
                });
            } else if (data.type === "point") {
                seq++;
                data.element.animate({
                    opacity: {
                        begin: seq * delays,
                        dur: durations,
                        from: 0,
                        to: 1,
                        easing: "ease",
                    },
                });
            }
        });

        seq = 0;
    },
    startAnimationForBarChart: function (chart) {
        chart.on("draw", function (data) {
            if (data.type === "bar") {
                seq2++;
                data.element.animate({
                    opacity: {
                        begin: seq2 * delays2,
                        dur: durations2,
                        from: 0,
                        to: 1,
                        easing: "ease",
                    },
                });
            }
        });

        seq2 = 0;
    },

    initFullCalendar: function () {
        $calendarsw = $("#fullCalendarsw");
        $calendarao = $("#fullCalendarao");
        $calendar = $("#fullCalendar");
        $calendarper = $("#calendarPersonal");

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
            editable: true,
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            dayNames: [
                "Domingo",
                "Lunes",
                "Martes",
                "Miércoles",
                "Jueves",
                "Viernes",
                "Sábado",
            ],
            firstDay: (Monday = 1),
            selectHelper: true,
            showNonCurrentDates: true,

            // allow "more" link when too many events
            eventRender: function (event, element, view) {
                var allDay = true;
                if (event.allDay === "true") {
                    event.allDay = true;
                    allDay = event.allDay;
                } else {
                    event.allDay = false;
                    allDay = event.allDay;
                }
                element
                    .find(".fc-title")
                    .append(
                        "<div>" +
                            '<span id="ocupado-espacio" style="font-size: 10px"> </span>' +
                            "</div>"
                    );
                espacios(element, event);
                element.find(".fc-time").hide();
            },
            eventOrder: "hold",
            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: {
                url: "/all/campanias",
                cache: false,
                lazyFetching: false,
            },
            viewRender: function (view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != "days") {
                    $(element).find(".fc-scroller").perfectScrollbar();
                }
            },
            header: {
                left: "today",
                center: "prevYear, prev, title, next, nextYear",
                right: "month,agendaWeek,agendaDay",
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: {
                    // name of view
                    titleFormat: "MMMM YYYY",
                    // other view-specific options here
                },
                week: {
                    titleFormat: "D MMMM YYYY",
                },
                day: {
                    titleFormat: "D MMM, YYYY",
                },
            },

            select: function (start, end, jsEvent) {
                $("#crearEvento")[0].reset();
                $("#uikit-create").modal("show");
                var start = $.fullCalendar.formatDate(start, "DD-MMM-Y");
                var end = $.fullCalendar.formatDate(end, "DD-MMM-Y");
                $("#start").val(start);
                $("#end").val(end);
            },
            editable: true,
            eventLimit: 4,

            eventDrop: function (event, end, jsEvent) {
                var ustart = $.fullCalendar.formatDate(
                    event.start,
                    "Y-MM-DD HH:mm:ss"
                );
                var uend = $.fullCalendar.formatDate(
                    event.end,
                    "Y-MM-DD HH:mm:ss"
                );
                var utitle = event.title;
                var id = event.id;
                //console.log(eventos);
                Swal.fire({
                    title: "¿Está seguro de cambiar de fecha?",
                    text: "Esta acción no se puede revertir!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, actualizar.",
                }).then((result) => {
                    if (result.value) {
                        var datos = {
                            id: id,
                            title: utitle,
                            end: uend,
                            start: ustart,
                        };
                        console.log(datos);
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            url: "/eventos/drop",
                            type: "POST",
                            data: datos,
                            success: function (response) {
                                var messaje = response;
                                var type = messaje[0];
                                var mess = messaje[1];

                                if (type == "error") {
                                    toastr.error(mess, "", {
                                        timeOut: 3000,
                                    });
                                } else if (type == "success") {
                                    $calendar.fullCalendar("refetchEvents");
                                    //console.log(response);
                                    toastr.success(mess, "", {
                                        timeOut: 3000,
                                    });
                                } else {
                                    toastr.info(mess, "", {
                                        timeOut: 3000,
                                    });
                                }
                            },
                        });
                    }
                    $calendar.fullCalendar("refetchEvents");
                    return false;
                });
            },
            eventClick: function (event, jsEvent, view) {
                $("#modificarEvento")[0].reset();
                $("#modalEventEditar").modal("show");
                var start = $.fullCalendar.formatDate(event.start, "DD-MMM-Y");
                var end = $.fullCalendar.formatDate(event.end, "DD-MMM-Y");

                $("#ustart").val(start);
                $("#uend").val(end);
                $("#unombre").val(event.title);
                $("#id_up").val(event.id);
                $("#idEventEdit").val(event.id);
                $("#uestatus").val(
                    event.estado + " (Hold - " + event.hold + ")"
                );
                let id = event.id;
                //Livewire.emit("openModalEvent", id);
                //console.log(view);
                //datos(id);
                var datos = {
                    id: id,
                };
                collection(datos);
                consultar(datos);

                //parametros
            },
        });
        $calendarsw.fullCalendar({
            editable: true,
            eventLimit: 5,
            locale: "es",
            ISO: "8601",
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            dayNames: [
                "Domingo",
                "Lunes",
                "Martes",
                "Miércoles",
                "Jueves",
                "Viernes",
                "Sábado",
            ],
            firstDay: (Monday = 1),
            // allow "more" link when too many events
            eventRender: function (event, element, view) {
                var allDay = false;
                if (event.allDay === "true") {
                    event.allDay = true;
                    allDay = event.allDay;
                } else {
                    event.allDay = false;
                    allDay = event.allDay;
                }
                element
                    .find(".fc-title")
                    .append(
                        '<div class="hr-line-solid-no-margin"></div>' +
                            '<span class="uk-text-left" style="font-size: 10px">' +
                            event.tipo_evento +
                            "</span> <br>" +
                            '<span style="font-size: 10px">' +
                            event.estado +
                            " " +
                            event.hold +
                            "</span> <br>" +
                            '<span style="font-size: 10px"> Creado por: ' +
                            event.users +
                            "</span></br>" +
                            '<span id="ocupado-espacio" style="font-size: 10px"> </span></br></div>'
                    );

                //element.find('.fc-future').append('');
                espacios(element, event);
                element.find(".fc-time").hide();
            },
            eventOrder: "hold",
            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: {
                url: "/eventos/get_sw",
                cache: false,
                lazyFetching: false,
            },

            displayEventTime: true,
            editable: true,
            viewRender: function (view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != "month") {
                    $(element).find(".fc-scroller").perfectScrollbar();
                }
            },
            header: {
                left: "today",
                center: "prevYear, prev, title, next, nextYear",
                right: "month,agendaWeek,agendaDay",
            },
            defaultDate: today,
            views: {
                eventLimit: 5,
                month: {
                    // name of view
                    titleFormat: "MMMM YYYY",
                    // other view-specific options here
                },
                week: {
                    titleFormat: "MMMM D YYYY",
                },
                day: {
                    titleFormat: "D MMM, YYYY",
                },
            },
            selectable: true,
            selectHelper: true,
            select: function (start, jsEvent) {
                $("#crearEvento")[0].reset();
                //UIkit.modal('#uikit-create').show();
                $("#uikit-create").modal("show");
                var start = $.fullCalendar.formatDate(start, "DD-MMM-Y");
                $("#started").val(start);
            },
            eventDrop: function (event, jsEvent) {
                var ustart = $.fullCalendar.formatDate(
                    event.start,
                    "Y-MM-DD HH:mm:ss"
                );
                var uend = $.fullCalendar.formatDate(
                    event.end,
                    "Y-MM-DD HH:mm:ss"
                );
                var utitle = event.title;
                var id = event.id;
                //console.log(eventos);
                Swal.fire({
                    title: "¿Está seguro de cambiar de fecha?",
                    text: "Esta acción no se puede revertir!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, actualizar.",
                }).then((result) => {
                    if (result.value) {
                        var datos = {
                            id: id,
                            title: utitle,
                            end: uend,
                            start: ustart,
                        };
                        console.log(datos);
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            url: "/eventos/drop",
                            type: "POST",
                            data: datos,
                            success: function (response) {
                                var messaje = response;
                                var type = messaje[0];
                                var mess = messaje[1];

                                if (type == "error") {
                                    toastr.error(mess, "", {
                                        timeOut: 3000,
                                    });
                                } else if (type == "success") {
                                    $calendar.fullCalendar("refetchEvents");
                                    //console.log(response);
                                    toastr.success(mess, "", {
                                        timeOut: 3000,
                                    });
                                } else {
                                    toastr.info(mess, "", {
                                        timeOut: 3000,
                                    });
                                }
                            },
                        });
                    }
                    $calendar.fullCalendar("refetchEvents");
                    return false;
                });
            },
            eventClick: function (event, jsEvent, view) {
                $("#modificarEvento")[0].reset();
                //UIkit.offcanvas('#offcanvas-flip').toggle();
                $("#modalEventEditar").modal("show");
                //event.preventDefault();
                var start = $.fullCalendar.formatDate(event.start, "Y-MMM-DD");

                $("#ustart").val(start);
                $("#unombre").val(event.title);
                $("#id_up").val(event.id);
                var id = event.id;
                //console.log(event);
                //datos(id);
                var datos = {
                    id: id,
                };

                collection(datos);
                consultar(datos);
                //parametros
            },
        });
        $calendarao.fullCalendar({
            editable: true,
            eventLimit: 5,
            locale: "es",
            ISO: "8601",
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            dayNames: [
                "Domingo",
                "Lunes",
                "Martes",
                "Miércoles",
                "Jueves",
                "Viernes",
                "Sábado",
            ],
            firstDay: (Monday = 1),
            // allow "more" link when too many events
            eventRender: function (event, element, view) {
                var allDay = false;
                if (event.allDay === "true") {
                    event.allDay = true;
                    allDay = event.allDay;
                } else {
                    event.allDay = false;
                    allDay = event.allDay;
                }
                element
                    .find(".fc-title")
                    .append(
                        '<div class="hr-line-solid-no-margin"></div>' +
                            '<span class="uk-text-left" style="font-size: 10px">' +
                            event.tipo_evento +
                            "</span> <br>" +
                            '<span style="font-size: 10px">' +
                            event.estado +
                            " " +
                            event.hold +
                            "</span> <br>" +
                            '<span style="font-size: 10px"> Creado por: ' +
                            event.users +
                            "</span></br>" +
                            '<span id="ocupado-espacio" style="font-size: 10px"> </span></br></div>'
                    );
                espacios(element, event);
                element.find(".fc-time").hide();
            },
            eventOrder: "hold",
            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: {
                url: "/eventos/get_ao",
                cache: false,
                lazyFetching: false,
            },
            displayEventTime: true,
            editable: true,
            viewRender: function (view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != "month") {
                    $(element).find(".fc-scroller").perfectScrollbar();
                }
            },
            header: {
                left: "today",
                center: "prevYear, prev, title, next, nextYear",
                right: "month,agendaWeek,agendaDay",
            },
            defaultDate: today,
            views: {
                eventLimit: 5,
                month: {
                    // name of view
                    titleFormat: "MMMM YYYY",
                    // other view-specific options here
                },
                week: {
                    titleFormat: "MMMM D YYYY",
                },
                day: {
                    titleFormat: "D MMM, YYYY",
                },
            },
            selectable: true,
            selectHelper: true,
            select: function (start, jsEvent) {
                $("#crearEvento")[0].reset();
                //UIkit.modal('#uikit-create').show();
                $("#uikit-create").modal("show");
                var start = $.fullCalendar.formatDate(start, "DD-MMM-Y");
                $("#started").val(start);
            },
            eventDrop: function (event, jsEvent) {
                var ustart = $.fullCalendar.formatDate(
                    event.start,
                    "Y-MM-DD HH:mm:ss"
                );
                var uend = $.fullCalendar.formatDate(
                    event.end,
                    "Y-MM-DD HH:mm:ss"
                );
                var utitle = event.title;
                var id = event.id;
                //console.log(eventos);
                Swal.fire({
                    title: "¿Está seguro de cambiar de fecha?",
                    text: "Esta acción no se puede revertir!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, actualizar.",
                }).then((result) => {
                    if (result.value) {
                        var datos = {
                            id: id,
                            title: utitle,
                            end: uend,
                            start: ustart,
                        };
                        console.log(datos);
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            url: "/eventos/drop",
                            type: "POST",
                            data: datos,
                            success: function (response) {
                                var messaje = response;
                                var type = messaje[0];
                                var mess = messaje[1];

                                if (type == "error") {
                                    toastr.error(mess, "", {
                                        timeOut: 3000,
                                    });
                                } else if (type == "success") {
                                    $calendar.fullCalendar("refetchEvents");
                                    //console.log(response);
                                    toastr.success(mess, "", {
                                        timeOut: 3000,
                                    });
                                } else {
                                    toastr.info(mess, "", {
                                        timeOut: 3000,
                                    });
                                }
                            },
                        });
                    }
                    $calendar.fullCalendar("refetchEvents");
                    return false;
                });
            },
            eventClick: function (event, jsEvent, view) {
                $("#modificarEvento")[0].reset();
                //UIkit.offcanvas('#offcanvas-flip').toggle();
                $("#modalEventEditar").modal("show");
                //event.preventDefault();
                var start = $.fullCalendar.formatDate(event.start, "Y-MMM-DD");

                $("#ustart").val(start);
                $("#unombre").val(event.title);
                $("#id_up").val(event.id);
                var id = event.id;
                //console.log(event);
                //datos(id);
                var datos = {
                    id: id,
                };

                collection(datos);
                consultar(datos);
            },
        });
    },
    initVectorMap: function () {
        var mapData = {
            AU: 760,
            BR: 550,
            CA: 120,
            DE: 1300,
            FR: 540,
            GB: 690,
            GE: 200,
            IN: 200,
            RO: 600,
            RU: 300,
            US: 2920,
        };

        $("#worldMap").vectorMap({
            map: "world_mill_en",
            backgroundColor: "transparent",
            zoomOnScroll: false,
            regionStyle: {
                initial: {
                    fill: "#e4e4e4",
                    "fill-opacity": 0.9,
                    stroke: "none",
                    "stroke-width": 0,
                    "stroke-opacity": 0,
                },
            },

            series: {
                regions: [
                    {
                        values: mapData,
                        scale: ["#AAAAAA", "#444444"],
                        normalizeFunction: "polynomial",
                    },
                ],
            },
        });
    },
};

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
}

function hide(element) {
    UIkit.modal(element).hide();
}
//llenado de los select
function consultar(datos) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/only/get_estatus",
        type: "GET",
        data: datos,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            data = response;
            let medio_nombre = data[0].nombre_medio;
            let id_medio = data[0].id_medio;
            let cliente_nombre = data[0].nombre_cliente;
            let id_cliente = data[0].id_cliente;

            //console.log(data);
            $("#umedio").append(
                '<option hidden selected value="' +
                    id_medio +
                    '">' +
                    medio_nombre +
                    "</option>"
            );
            $("#ucliente").append(
                '<option hidden selected value="' +
                    id_cliente +
                    '">' +
                    cliente_nombre +
                    "</option>"
            );
        },
    });
}
//get espacio for edit
function collection(datos) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/only/get_espacio",
        type: "GET",
        data: datos,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            $("#cargadatos").empty();
            datas = response;
            datas.forEach(function (data) {
                //console.log(data.nombre);
                $("#cargadatos").append(
                    "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>" +
                        "<td class='py-2 px-3 text-sm font-normal text-gray-700 whitespace-nowrap dark:text-white'>" +
                        "<span class='pl-2'>" +
                        data.nombre +
                        "</span>" +
                        "</td>" +
                        "<td class='py-2 px-3 text-sm font-normal text-gray-700 whitespace-nowrap dark:text-white' >" +
                        '<button type="button" id="delespacio" class="px-2 text-red-600" onclick="eliminar(' +
                        data.id +
                        ", " +
                        data.id_campania +
                        ')" >' +
                        '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' +
                        "</button> " +
                        "</td>" +
                        "</tr>"
                );
            });
        },
    });
}

function espacios(element, event) {
    data = {
        id: event.id,
    };
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/only/espacio",
        type: "GET",
        data: data,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            datas = response;
            //console.log(datas);
            datas.forEach(function (data) {
                nombre = data.nombre;
                element.find("#ocupado-espacio").append(" " + nombre + " ,");
                //console.log(data.nombre);
            });
        },
        error: function (r) {
            console.log(r);
        },
    });
}

actionStatus = (camp) => {
    data = {
        id: camp.id,
    };

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/campanias/first",
        type: "GET",
        data: data,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            campania = response;
            if (campania.id_campania == camp.id) {
                var element = document.getElementById("confirmar");
                var challenge = document.getElementById("challenge");
                element.classList.remove("hidden");
                challenge.classList.add("hidden");
            } else {
                var element = document.getElementById("challenge");
                var confirmar = document.getElementById("confirmar");
                element.classList.remove("hidden");
                confirmar.classList.add("hidden");
            }
        },
        error: function (r) {
            console.log(r);
        },
    });
};
