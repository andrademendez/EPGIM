require("./bootstrap");

import Alpine from "alpinejs";
import * as FilePond from "filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImageTransform from "filepond-plugin-image-transform";
import FilePondPluginImageEdit from "filepond-plugin-image-edit";
import FilePondPluginImageResize from "filepond-plugin-image-resize";
import Pikaday from "pikaday";
import "boxicons";

window.Alpine = Alpine;
window.Pikaday = Pikaday;
window.FilePond = FilePond;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginImageExifOrientation = FilePondPluginImageExifOrientation;
window.FilePondPluginImageCrop = FilePondPluginImageCrop;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImageTransform = FilePondPluginImageTransform;
window.FilePondPluginImageEdit = FilePondPluginImageEdit;
window.FilePondPluginImageResize = FilePondPluginImageResize;

import ToastComponent from "../../vendor/usernotnull/tall-toasts/dist/js/tall-toasts";

Alpine.data("ToastComponent", ToastComponent);

Alpine.start();
