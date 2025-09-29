<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from htmlstream.com/preview/front-dashboard-v2.1.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Nov 2024 10:27:09 GMT -->
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Groupe clis</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset("dashboard/img/logo2.jpg") }}">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="{{ asset("dashboard/assets/css/vendor.min.css") }}">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="{{ asset("dashboard/assets/css/theme.minc619.css?v=1.0") }}">

  <link rel="preload" href="{{ asset("dashboard/assets/css/theme.min.css") }}" data-hs-appearance="default" as="style">
  <link rel="preload" href="{{ asset("dashboard/assets/css/theme-dark.min.css") }}" data-hs-appearance="dark" as="style">
  <!-- <link rel="stylesheet" href="{{ asset("dashboard/css/style.css") }}" >
  <link href="{{ asset("auth/css/style.css") }}" rel="stylesheet" /> -->

   <style data-hs-appearance-onload-styles>
        *
        {
        transition: unset !important;
        }

        body
        {
        opacity: 0;
        }
    </style>

    <script>
        window.hs_config = {"autopath":"@@autopath","deleteLine":"hs-builder:delete","deleteLine:build":"hs-builder:build-delete","deleteLine:dist":"hs-builder:dist-delete","previewMode":false,"startPath":"/index.html","vars":{"themeFont":"https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap","version":"?v=1.0"},"layoutBuilder":{"extend":{"switcherSupport":true},"header":{"layoutMode":"default","containerMode":"container-fluid"},"sidebarLayout":"default"},"themeAppearance":{"layoutSkin":"default","sidebarSkin":"default","styles":{"colors":{"primary":"#377dff","transparent":"transparent","white":"#fff","dark":"132144","gray":{"100":"#f9fafc","900":"#1e2022"}},"font":"Inter"}},"languageDirection":{"lang":"en"},"skipFilesFromBundle":{"dist":["assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","assets/js/demo.js"],"build":["assets/css/theme.css","assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js","assets/js/demo.js","assets/css/theme-dark.html","assets/css/docs.css","assets/vendor/icon-set/style.html","assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.html","assets/js/demo.js"]},"minifyCSSFiles":["assets/css/theme.css","assets/css/theme-dark.css"],"copyDependencies":{"dist":{"*assets/js/theme-custom.js":""},"build":{"*assets/js/theme-custom.js":"","node_modules/bootstrap-icons/font/*fonts/**":"assets/css"}},"buildFolder":"","replacePathsToCDN":{},"directoryNames":{"src":"./src","dist":"./dist","build":"./build"},"fileNames":{"dist":{"js":"theme.min.js","css":"theme.min.css"},"build":{"css":"theme.min.css","js":"theme.min.js","vendorCSS":"vendor.min.css","vendorJS":"vendor.min.js"}},"fileTypes":"jpg|png|svg|mp4|webm|ogv|json"}
        window.hs_config.gulpRGBA = (p1) => {
            const options = p1.split(',')
            const hex = options[0].toString()
            const transparent = options[1].toString()

            var c;
            if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
                c= hex.substring(1).split('');
                if(c.length== 3){
                c= [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c= '0x'+c.join('');
                return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',' + transparent + ')';
            }
            throw new Error('Bad Hex');
            }
                        window.hs_config.gulpDarken = (p1) => {
            const options = p1.split(',')

            let col = options[0].toString()
            let amt = -parseInt(options[1])
            var usePound = false

            if (col[0] == "#") {
                col = col.slice(1)
                usePound = true
            }
            var num = parseInt(col, 16)
            var r = (num >> 16) + amt
            if (r > 255) {
                r = 255
            } else if (r < 0) {
                r = 0
            }
            var b = ((num >> 8) & 0x00FF) + amt
            if (b > 255) {
                b = 255
            } else if (b < 0) {
                b = 0
            }
            var g = (num & 0x0000FF) + amt
            if (g > 255) {
                g = 255
            } else if (g < 0) {
                g = 0
            }
            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
            }
                        window.hs_config.gulpLighten = (p1) => {
            const options = p1.split(',')

            let col = options[0].toString()
            let amt = parseInt(options[1])
            var usePound = false

            if (col[0] == "#") {
                col = col.slice(1)
                usePound = true
            }
            var num = parseInt(col, 16)
            var r = (num >> 16) + amt
            if (r > 255) {
                r = 255
            } else if (r < 0) {
                r = 0
            }
            var b = ((num >> 8) & 0x00FF) + amt
            if (b > 255) {
                b = 255
            } else if (b < 0) {
                b = 0
            }
            var g = (num & 0x0000FF) + amt
            if (g > 255) {
                g = 255
            } else if (g < 0) {
                g = 0
            }
            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
        }
    </script>
</head>

<body>

    <script src="{{ asset("dashboard/assets/js/hs.theme-appearance.js") }}"></script>
    <!-- <script src="{{ asset("dashboard/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js") }}"></script> -->

    @include('dashboard.principale.layout.utils.nav')
        @yield('body')
    @include('dashboard.principale.layout.utils.footer')


    <!-- JS Implementing Plugins -->
    <script src="{{ asset("dashboard/assets/js/vendor.min.js") }}"></script>
    <!-- <script src="{{ asset("dashboard/assets/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js") }}"></script> -->

    <!-- JS Front -->
    <script src="{{ asset("dashboard/assets/js/theme.min.js") }}"></script>
    <!-- <script src="{{ asset("dashboard/assets/js/hs.theme-appearance-charts.js") }}"></script> -->

    <!-- perso -->
    <!-- <script src="{{ asset("dashboard/js/style.js") }}"></script>
    <script src="{{ asset("dashboard/js/oeil.js") }}"></script>
    <script src="{{ asset("perso/js/perso.js") }}"></script> -->



    <!-- autre -->
        <!-- JS Plugins Init. -->
        <!-- <script>
            (function() {
            window.onload = function () {
                

                // INITIALIZATION OF NAVBAR VERTICAL ASIDE
                // =======================================================
                new HSSideNav('.js-navbar-vertical-aside').init()


                // INITIALIZATION OF FORM SEARCH
                // =======================================================
                new HSFormSearch('.js-form-search')


                // INITIALIZATION OF BOOTSTRAP DROPDOWN
                // =======================================================
                HSBsDropdown.init()


                // INITIALIZATION OF FILE ATTACH
                // =======================================================
                new HSFileAttach('.js-file-attach')


                // INITIALIZATION OF STEP FORM
                // =======================================================
                new HSStepForm('.js-step-form', {
                finish: () => {
                    document.getElementById("addUserStepFormProgress").style.display = 'none'
                    document.getElementById("addUserStepProfile").style.display = 'none'
                    document.getElementById("addUserStepBillingAddress").style.display = 'none'
                    document.getElementById("addUserStepConfirmation").style.display = 'none'
                    document.getElementById("successMessageContent").style.display = 'block'
                    scrollToTop('#header');
                    const formContainer = document.getElementById('formContainer')
                },
                onNextStep: function () {
                    scrollToTop()
                },
                onPrevStep: function () {
                    scrollToTop()
                }
                })

                function scrollToTop(el = '.js-step-form') {
                el = document.querySelector(el)
                window.scrollTo({
                    top: (el.getBoundingClientRect().top + window.scrollY) - 30,
                    left: 0,
                    behavior: 'smooth'
                })
                }


                // INITIALIZATION OF ADD FIELD
                // =======================================================
                new HSAddField('.js-add-field', {
                addedField: field => {
                    HSCore.components.HSTomSelect.init(field.querySelector('.js-select-dynamic'))
                    HSCore.components.HSMask.init(field.querySelector('.js-input-mask'))
                }
                })


                // INITIALIZATION OF SELECT
                // =======================================================
                HSCore.components.HSTomSelect.init('.js-select', {
                render: {
                    'option': function (data, escape) {
                    return data.optionTemplate || `<div>${data.text}</div>>`
                    },
                    'item': function (data, escape) {
                    return data.optionTemplate || `<div>${data.text}</div>>`
                    }
                }
                })


                // INITIALIZATION OF INPUT MASK
                // =======================================================
                HSCore.components.HSMask.init('.js-input-mask')
            }
            })()
        </script> -->
        <!-- JS Plugins Init. -->
        <!-- <script>
            $(document).on('ready', function () {
            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            HSCore.components.HSDatatables.init($('#datatable'), {
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                classMap: {
                checkAll: '#datatableCheckAll',
                counter: '#datatableCounter',
                counterInfo: '#datatableCounterInfo'
                }
            },
            language: {
                zeroRecords: `<div class="text-center p-4">
                    <img class="mb-3" src="/dashboard/assets/svg/illustrations/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
                    <img class="mb-3" src="/dashboard/assets/svg/illustrations-light/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
                    <p class="mb-0">Aucun resultat trouvé</p>
                    </div>`
                    // No data to show
            }
            });

            const datatable = HSCore.components.HSDatatables.getItem(0)

            document.querySelectorAll('.js-datatable-filter').forEach(function (item) {
            item.addEventListener('change',function(e) {
                const elVal = e.target.value,
            targetColumnIndex = e.target.getAttribute('data-target-column-index'),
            targetTable = e.target.getAttribute('data-target-table');

            HSCore.components.HSDatatables.getItem(targetTable).column(targetColumnIndex).search(elVal !== 'null' ? elVal : '').draw()
            })
            })
        </script> -->
        <!-- Style Switcher JS -->
        <!-- <script>
        (function () {
            // STYLE SWITCHER
            // =======================================================
            const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
            const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

            // Function to set active style in the dorpdown menu and set icon for dropdown trigger
            const setActiveStyle = function () {
            $variants.forEach($item => {
                if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
                $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
                return $item.classList.add('active')
                }

                $item.classList.remove('active')
            })
            }

            // Add a click event to all items of the dropdown to set the style
            $variants.forEach(function ($item) {
            $item.addEventListener('click', function () {
                HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
            })
            })

            // Call the setActiveStyle on load page
            setActiveStyle()

            // Add event listener on change style to call the setActiveStyle function
            window.addEventListener('on-hs-appearance-change', function () {
            setActiveStyle()
            })
        })()
        </script> -->
        <!-- JS Plugins Init. -->
        <script>
            (function() {
            window.onload = function () {
                // INITIALIZATION OF BOOTSTRAP VALIDATION
                // =======================================================
                HSBsValidation.init('.js-validate', {
                onSubmit: data => {
                    data.event.preventDefault()
                    alert('Submited')
                }
                })


                // INITIALIZATION OF TOGGLE PASSWORD
                // =======================================================
                new HSTogglePassword('.js-toggle-password')
            }
            })()
        </script>
    <!-- autre -->

    <!-- index -->
        <!-- <script>
            $(document).on('ready', function () {
            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            HSCore.components.HSDatatables.init($('#datatable'), {
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                classMap: {
                checkAll: '#datatableCheckAll',
                counter: '#datatableCounter',
                counterInfo: '#datatableCounterInfo'
                }
            },
            language: {
                zeroRecords: `<div class="text-center p-4">
                    <img class="mb-3" src="./assets/svg/illustrations/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
                    <img class="mb-3" src="./assets/svg/illustrations-light/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
                    <p class="mb-0">No data to show</p>
                    </div>`
            }
            });

            const datatable = HSCore.components.HSDatatables.getItem(0)

            document.querySelectorAll('.js-datatable-filter').forEach(function (item) {
            item.addEventListener('change',function(e) {
                const elVal = e.target.value,
            targetColumnIndex = e.target.getAttribute('data-target-column-index'),
            targetTable = e.target.getAttribute('data-target-table');

            HSCore.components.HSDatatables.getItem(targetTable).column(targetColumnIndex).search(elVal !== 'null' ? elVal : '').draw()
            })
            })
        </script>
        <script>
            (function() {
            localStorage.removeItem('hs_theme')

            window.onload = function () {
                

                // INITIALIZATION OF NAVBAR VERTICAL ASIDE
                // =======================================================
                new HSSideNav('.js-navbar-vertical-aside').init()


                // INITIALIZATION OF FORM SEARCH
                // =======================================================
                const HSFormSearchInstance = new HSFormSearch('.js-form-search')

                if (HSFormSearchInstance.collection.length) {
                HSFormSearchInstance.getItem(1).on('close', function (el) {
                    el.classList.remove('top-0')
                })

                document.querySelector('.js-form-search-mobile-toggle').addEventListener('click', e => {
                    let dataOptions = JSON.parse(e.currentTarget.getAttribute('data-hs-form-search-options')),
                    $menu = document.querySelector(dataOptions.dropMenuElement)

                    $menu.classList.add('top-0')
                    $menu.style.left = 0
                })
                }


                // INITIALIZATION OF BOOTSTRAP DROPDOWN
                // =======================================================
                HSBsDropdown.init()


                // INITIALIZATION OF CHARTJS
                // =======================================================
                HSCore.components.HSChartJS.init('.js-chart')


                // INITIALIZATION OF CHARTJS
                // =======================================================
                HSCore.components.HSChartJS.init('#updatingBarChart')
                const updatingBarChart = HSCore.components.HSChartJS.getItem('updatingBarChart')

                // Call when tab is clicked
                document.querySelectorAll('[data-bs-toggle="chart-bar"]').forEach(item => {
                item.addEventListener('click', e => {
                    let keyDataset = e.currentTarget.getAttribute('data-datasets')

                    const styles = HSCore.components.HSChartJS.getTheme('updatingBarChart', HSThemeAppearance.getAppearance())

                    if (keyDataset === 'lastWeek') {
                    updatingBarChart.data.labels = ["Apr 22", "Apr 23", "Apr 24", "Apr 25", "Apr 26", "Apr 27", "Apr 28", "Apr 29", "Apr 30", "Apr 31"];
                    updatingBarChart.data.datasets = [
                        {
                        "data": [120, 250, 300, 200, 300, 290, 350, 100, 125, 320],
                        "backgroundColor": styles.data.datasets[0].backgroundColor,
                        "hoverBackgroundColor": styles.data.datasets[0].hoverBackgroundColor,
                        "borderColor": styles.data.datasets[0].borderColor,
                        "maxBarThickness": 10
                        },
                        {
                        "data": [250, 130, 322, 144, 129, 300, 260, 120, 260, 245, 110],
                        "backgroundColor": styles.data.datasets[1].backgroundColor,
                        "borderColor": styles.data.datasets[1].borderColor,
                        "maxBarThickness": 10
                        }
                    ];
                    updatingBarChart.update();
                    } else {
                    updatingBarChart.data.labels = ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"];
                    updatingBarChart.data.datasets = [
                        {
                        "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                        "backgroundColor": styles.data.datasets[0].backgroundColor,
                        "hoverBackgroundColor": styles.data.datasets[0].hoverBackgroundColor,
                        "borderColor": styles.data.datasets[0].borderColor,
                        "maxBarThickness": 10
                        },
                        {
                        "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225, 120],
                        "backgroundColor": styles.data.datasets[1].backgroundColor,
                        "borderColor": styles.data.datasets[1].borderColor,
                        "maxBarThickness": 10
                        }
                    ]
                    updatingBarChart.update();
                    }
                })
                })


                // INITIALIZATION OF CHARTJS
                // =======================================================
                HSCore.components.HSChartJS.init('.js-chart-datalabels', {
                plugins: [ChartDataLabels],
                options: {
                    plugins: {
                    datalabels: {
                        anchor: function (context) {
                        var value = context.dataset.data[context.dataIndex];
                        return value.r < 20 ? 'end' : 'center';
                        },
                        align: function (context) {
                        var value = context.dataset.data[context.dataIndex];
                        return value.r < 20 ? 'end' : 'center';
                        },
                        color: function (context) {
                        var value = context.dataset.data[context.dataIndex];
                        return value.r < 20 ? context.dataset.backgroundColor : context.dataset.color;
                        },
                        font: function (context) {
                        var value = context.dataset.data[context.dataIndex],
                            fontSize = 25;

                        if (value.r > 50) {
                            fontSize = 35;
                        }

                        if (value.r > 70) {
                            fontSize = 55;
                        }

                        return {
                            weight: 'lighter',
                            size: fontSize
                        };
                        },
                        formatter: function (value) {
                        return value.r
                        },
                        offset: 2,
                        padding: 0
                    }
                    },
                }
                })

                // INITIALIZATION OF SELECT
                // =======================================================
                HSCore.components.HSTomSelect.init('.js-select')


                // INITIALIZATION OF CLIPBOARD
                // =======================================================
                HSCore.components.HSClipboard.init('.js-clipboard')
            }
            })()
        </script>
        <script>
            (function () {
                // STYLE SWITCHER
                // =======================================================
                const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
                const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

                // Function to set active style in the dorpdown menu and set icon for dropdown trigger
                const setActiveStyle = function () {
                $variants.forEach($item => {
                    if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
                    $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
                    return $item.classList.add('active')
                    }

                    $item.classList.remove('active')
                })
                }

                // Add a click event to all items of the dropdown to set the style
                $variants.forEach(function ($item) {
                $item.addEventListener('click', function () {
                    HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
                })
                })

                // Call the setActiveStyle on load page
                setActiveStyle()

                // Add event listener on change style to call the setActiveStyle function
                window.addEventListener('on-hs-appearance-change', function () {
                setActiveStyle()
                })
            })()
        </script> -->
    <!-- index -->

    <!-- js .... -->
        <!-- <script>
            function toggleInput() {
                const select = document.getElementById("client");
                const addClient = document.getElementById("addClient");
                const ChoisirClient = document.getElementById("ChoisirClient");
                
                if (select.value === "Nouveau") {
                    addClient.style.display = "block";
                    ChoisirClient.style.display = "none";
                } else {
                    addClient.style.display = "none";
                    ChoisirClient.style.display = "block";
                }
            }

            // Appel au chargement initial de la page (utile en cas de validation échouée avec ancienne valeur)
            window.addEventListener('DOMContentLoaded', function () {
            toggleInput();
            });
        </script>
        <script>
            function typeClient() {
                const typeclient = document.getElementById("typeCli");
                const typeEntreprise = document.getElementById("typeEntreprise");
                const typeParticulier = document.getElementById("typeParticulier");
                
                if (typeclient.value === "0") {
                    typeEntreprise.style.display = "block";
                    typeParticulier.style.display = "none";
                } else {
                    typeEntreprise.style.display = "none";
                    typeParticulier.style.display = "block";
                }
            }

            // Appel au chargement initial de la page (utile en cas de validation échouée avec ancienne valeur)
            window.addEventListener('DOMContentLoaded', function () {
            typeClient();
            });
        </script>
        <script>
            function typeDevis() {
                const typedevis = document.getElementById("typeDev");
                const devisLocation = document.getElementById("devisLocation");
                
                if (typedevis.value === "0") {
                    devisLocation.style.display = "none";
                } else {
                    devisLocation.style.display = "block";
                }
            }

            // Appel au chargement initial de la page (utile en cas de validation échouée avec ancienne valeur)
            window.addEventListener('DOMContentLoaded', function () {
            typeDevis();
            });
        </script> -->
    <!-- js .... -->
    
</body>

</html>