require("./bootstrap");

import Alpine from "alpinejs";
import Pikaday from "pikaday";

import "jquery-ui/ui/widgets/draggable";
import "jquery-ui/ui/widgets/droppable";
import "jquery-ui/ui/widgets/datepicker";
import "boxicons";
import "@fortawesome/fontawesome-free";

import Swal from "sweetalert2";
import {
    Chart,
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle,
} from "chart.js";

Chart.register(
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle
);
// CommonJS

window.Swal = Swal;
window.Alpine = Alpine;
window.Pikaday = Pikaday;

import ToastComponent from "../../vendor/usernotnull/tall-toasts/dist/js/tall-toasts";

Alpine.data("ToastComponent", ToastComponent);

Alpine.start();
