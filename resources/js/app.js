require("./bootstrap");

import Alpine from "alpinejs";
import Pikaday from "pikaday";

import "jquery-ui/ui/widgets/draggable";
import "jquery-ui/ui/widgets/droppable";
import "jquery-ui/ui/widgets/datepicker";
import "boxicons";
import "@fortawesome/fontawesome-free";

import Swal from "sweetalert2";

// CommonJS

window.Swal = Swal;
window.Alpine = Alpine;
window.Pikaday = Pikaday;

import ToastComponent from "../../vendor/usernotnull/tall-toasts/dist/js/tall-toasts";

Alpine.data("ToastComponent", ToastComponent);

Alpine.start();
