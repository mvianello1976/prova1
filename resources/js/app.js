import './bootstrap';

import AirDatepicker from "air-datepicker";
import 'air-datepicker/air-datepicker.css'
import localeIT from 'air-datepicker/locale/it'

import QrScanner from "qr-scanner";

import Tooltip from "@ryangjchandler/alpine-tooltip";

Alpine.plugin(Tooltip)

window.QrScanner = QrScanner
window.airdatepicker = AirDatepicker
window.localeIT = localeIT
