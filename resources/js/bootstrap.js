window._ = require("lodash");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
try {
    window.toastr = require("toastr/toastr");
    window.moment = require("moment");
    window.$ = window.jQuery = require("jquery");
    window.Chart = require("chart.js/dist/chart");
    // window.Turbolinks = require("turbolinks");

    // Turbolinks.start();
} catch (e) {}

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
