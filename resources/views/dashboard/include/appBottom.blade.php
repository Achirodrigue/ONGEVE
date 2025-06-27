
    <!-- JS Implementing Plugins -->
    <script src="{{ asset("dashboard/assets/js/vendor.min.js") }}"></script>
    <script src="{{ asset("dashboard/assets/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js") }}"></script>

    <!-- JS Front -->
    <script src="{{ asset("dashboard/assets/js/theme.min.js") }}"></script>
    <script src="{{ asset("dashboard/assets/js/hs.theme-appearance-charts.js") }}"></script>

    <!-- perso -->
    <script src="{{ asset("dashboard/js/style.js") }}"></script>
    <script src="{{ asset("dashboard/js/oeil.js") }}"></script>

    <!-- JS Plugins Init. -->
    <script>
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
    </script>

    <!-- JS Plugins Init. -->
    <script>
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
    </script>

    <!-- Style Switcher JS -->
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
    </script>

    <script>
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
    </script>
    
</body>

</html>