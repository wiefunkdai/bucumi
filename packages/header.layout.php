<!--//
 * PROJECT AKHIR SEMESTER PALCOMTECH
 * Mata Kuliah: Pemograman Web Dasar
 * Dosen : Bpk. Hendra Efendi
 * 
 * DAFTAR KELOMPOK :
 * - Stephanus Bagus Saputra
 * - Muhammd Ilham brosnansyah
 * - Muhamad Firdaus 
 * - M Ihsan Adrian 
 * - M. Chaidar Ramadhan 
 * - Mega
//-->
<!doctype html>
<html lang="en">
  <head>
    <base href="<?= create_url('/') ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($pageTitle) ? htmlentities($pageTitle).' - ' : ''; ?>Bucumi (Pustaka Buku)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style type="text/css">
      :root {
        --bs-primary: #d45500ff;
        --bs-secondary: #d455009a;
      }
      .text-bucumi {
        color: #d45500ff;
      }
      .bg-bucumi {
        background-color: #d45500ff;
      }
      .btn-bucumi {
        --bs-btn-color: #fff;
        --bs-btn-bg: #d45500ff;
        --bs-btn-border-color: #d45500ff;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #d455009a;
        --bs-btn-hover-border-color: #ba4e00ff;
        --bs-btn-focus-shadow-rgb: 49,132,253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #ba3600ff;
        --bs-btn-active-border-color: #ba4e00ff;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #ba3600ff;
        --bs-btn-disabled-border-color: #d45500ff;
      }
      .btn-outline-bucumi {
        --bs-btn-color: #d45500ff;
        --bs-btn-border-color: #d45500ff;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #d45500ff;
        --bs-btn-hover-border-color: #d45500ff;
        --bs-btn-focus-shadow-rgb: 13,110,253;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #d45500ff;
        --bs-btn-active-border-color: #d45500ff;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #d45500ff;
        --bs-btn-disabled-bg: transparent;
        --bs-btn-disabled-border-color: #d45500ff;
        --bs-gradient: none;
      }
      header.navbar .navbar-wrapper {
        flex-wrap: nowrap;
        width: 100%;
      }

      header.navbar .form-search {
        position: relative;
      }

      header.navbar .form-search > .btn-search {
        position: absolute;
        right: 0;
        top: 0;
        text-decoration: none;
        border: 0;
      }

      @media (max-width: 960px) {
        header.navbar .navbar-wrapper,
        header.navbar .navbar-brand-group {
          flex-wrap: wrap;
        }
        header.navbar .navbar-wrapper {
          flex-wrap: wrap;
          width: 100%;
        }
        header.navbar .navbar-brand {
          justify-content: center;
          display: flex;
          flex-wrap: wrap;
          flex-grow: 1;
        }
      }

.form-floating > .select2-container {
  padding: 1rem 0.75rem;
  border-radius: var(--bs-border-radius);
  height: calc(3.5rem + calc(var(--bs-border-width) * 2));
  min-height: calc(3.5rem + calc(var(--bs-border-width) * 2));
  line-height: 1.25;
  border: var(--bs-border-width) solid var(--bs-border-color);
}
.form-floating > .select2-container::-moz-placeholder {
  color: transparent;
}
.form-floating > .select2-container::placeholder {
  color: transparent;
}
.form-floating > .select2-container:not(:-moz-placeholder-shown) {
  padding-top: 1.625rem;
  padding-bottom: 2.256rem;
}
.form-floating > .select2-container:focus, 
.form-floating > .select2-container:not(:placeholder-shown) {
  padding-top: 1.625rem;
  padding-bottom: 2.256rem;
}
.form-floating > .select2-container:-webkit-autofill {
  padding-top: 1.625rem;
  padding-bottom: .625rem;
}
.form-floating > .select2-container {
  padding-top: 1.625rem;
  padding-bottom: .625rem;
}
.form-floating > .select2-container:not(:focus) {
  --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
  display: block;
  width: 100%;
  padding: 1.625rem 2.25rem 2.256rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 16px 12px;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.form-floating > .select2-container:not(:-moz-placeholder-shown) ~ label {
  color: rgba(var(--bs-body-color-rgb), 0.65);
  transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
}
.form-floating > .select2-container:focus ~ label,
.form-floating > .select2-container:not(:placeholder-shown) ~ label,
.form-floating > .select2-container ~ label {
  color: rgba(var(--bs-body-color-rgb), 0.65);
  transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
}
.form-floating > .select2-container:not(:-moz-placeholder-shown) ~ label::after {
  position: absolute;
  inset: 1rem 0.375rem;
  z-index: -1;
  height: 1.5em;
  content: "";
  background-color: var(--bs-body-bg);
  border-radius: var(--bs-border-radius);
}
.form-floating > .select2-container:focus ~ label::after,
.form-floating > .select2-container:not(:placeholder-shown) ~ label::after,
.form-floating > .select2-container ~ label::after {
  position: absolute;
  inset: 1rem 0.375rem;
  z-index: -1;
  height: 1.5em;
  content: "";
  background-color: var(--bs-body-bg);
  border-radius: var(--bs-border-radius);
}
.form-floating > .select2-container:-webkit-autofill ~ label {
  color: rgba(var(--bs-body-color-rgb), 0.65);
  transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
}
.form-floating > .select2-container:disabled ~ label {
  color: #6c757d;
}
.form-floating > .select2-container:disabled ~ label::after {
  background-color: var(--bs-secondary-bg);
}
.form-floating > .select2-container--default .select2-selection--single {
  border: none;
}
.form-floating > .select2-container--open {
  --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
  display: block;
  width: 100%;
  padding: 0.375rem 2.25rem 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 16px 12px;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  border-color: #86b7fe;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
.form-floating > .select2-container--open[multiple],
.form-floating > .select2-container--open[size]:not([size="1"]) {
  padding-right: 0.75rem;
  background-image: none;
}
.form-floating > .select2-container--open:disabled {
  background-color: var(--bs-secondary-bg);
}
.form-floating > .select2-container--open:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 var(--bs-body-color);
}

.was-validated .form-control:valid ~ .select2-container, 
.form-control.is-valid ~ .select2-container {
  border-color: var(--bs-form-valid-border-color);
  padding-right: calc(1.5em + 0.75rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right calc(0.375em + 0.1875rem) center;
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
.was-validated .form-control:valid ~ .select2-container:focus, 
.form-control.is-valid ~ .select2-container:focus {
  border-color: var(--bs-form-valid-border-color);
  box-shadow: 0 0 0 0.25rem rgba(var(--bs-success-rgb), 0.25);
}
.was-validated .form-select:valid ~ .select2-container, 
.form-select.is-valid ~ .select2-container {
  border-color: var(--bs-form-valid-border-color);
}
.was-validated .form-select:valid:not([multiple]):not([size]) ~ .select2-container, 
.was-validated .form-select:valid:not([multiple])[size="1"] ~ .select2-container, 
.form-select.is-valid:not([multiple]):not([size]) ~ .select2-container,
.form-select.is-valid:not([multiple])[size="1"] ~ .select2-container {
  --bs-form-select-bg-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
  padding-right: 4.125rem;
  background-position: right 0.75rem center, center right 2.25rem;
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
.was-validated .form-select:valid ~ .select2-container:focus, 
.form-select.is-valid ~ .select2-container:focus,
.form-select.is-invalid ~ .select2-container--open {
  border-color: var(--bs-form-valid-border-color);
  box-shadow: 0 0 0 0.25rem rgba(var(--bs-success-rgb), 0.25);
}

.was-validated .form-control-color:valid ~ .select2-container, 
.form-control-color.is-valid ~ .select2-container {
  width: calc(3rem + calc(1.5em + 0.75rem));
}

.was-validated .input-group > .form-control:not(:focus):valid ~ .select2-container, 
.input-group > .form-control:not(:focus).is-valid ~ .select2-container,
.was-validated .input-group > .form-select:not(:focus):valid ~ .select2-container,
.input-group > .form-select:not(:focus).is-valid ~ .select2-container {
  z-index: 3;
}

.was-validated .form-control:invalid ~ .select2-container,
.form-control.is-invalid ~ .select2-container {
  border-color: var(--bs-form-invalid-border-color);
  padding-right: calc(1.5em + 0.75rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right calc(0.375em + 0.1875rem) center;
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
.was-validated .form-control:invalid ~ .select2-container:focus, 
.form-control.is-invalid ~ .select2-container:focus,
.form-control.is-invalid ~ .select2-container--open {
  border-color: var(--bs-form-invalid-border-color);
  box-shadow: 0 0 0 0.25rem rgba(var(--bs-danger-rgb), 0.25);
}
.was-validated .form-select:invalid ~ .select2-container,
.form-select.is-invalid ~ .select2-container {
  border-color: var(--bs-form-invalid-border-color);
}
.was-validated .form-select:invalid:not([multiple]):not([size]) ~ .select2-container, 
.was-validated .form-select:invalid:not([multiple])[size="1"] ~ .select2-container, 
.form-select.is-invalid:not([multiple]):not([size]) ~ .select2-container, 
.form-select.is-invalid:not([multiple])[size="1"] ~ .select2-container {
  --bs-form-select-bg-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
  padding-right: 4.125rem;
  background-position: right 0.75rem center, center right 2.25rem;
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
.was-validated .form-select:invalid ~ .select2-container:focus, 
.form-select.is-invalid ~ .select2-container:focus,
.form-select.is-invalid ~ .select2-container--open {
  border-color: var(--bs-form-invalid-border-color);
  box-shadow: 0 0 0 0.25rem rgba(var(--bs-danger-rgb), 0.25);
}
.was-validated .form-control-color:invalid ~ .select2-container,
.form-control-color.is-invalid ~ .select2-container {
  width: calc(3rem + calc(1.5em + 0.75rem));
}

.select2-container--open .select2-dropdown--below {
  top: 0;
  border: var(--bs-border-width) solid #adb5bd;
  border-radius: var(--bs-border-radius);
  outline: 0;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
.select2-container--open .select2-dropdown--below .select2-results ul li {
  padding: 0.5rem 0.75rem;
}
.select2-dropdown, .select2-container--default .select2-search--dropdown .select2-search__field {
  border: var(--bs-border-width) solid var(--bs-border-color);
}
.select2-selection--single .select2-selection__rendered {
  padding-left: 0!important;
  padding-right: 0!important;
}
.select2-container--default .select2-search--dropdown { 
  padding: 0.75rem 0.5rem;
}
.select2-container--default .select2-results > .select2-results__options {
  margin-bottom: 0.5rem;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  display: none;
}

.grid-responsive {
    margin-bottom: 2rem;
}
.grid-responsive table {
    border-collapse: separate !important;
    border-spacing: 0;
    margin: auto;
    border: 1px solid rgba(222,226,230,0.5);
    box-shadow: 0px 0px 8px 1px rgba(222,226,230,0.2);
    -webkit-box-shadow: 0px 0px 8px 1px rgba(222,226,230,0.2);
    -moz-box-shadow: 0px 0px 8px 1px rgba(222,226,230,0.2);
}
.grid-responsive table a {
    color: #242437;
}
.grid-responsive table .dropstart .dropdown-toggle::before {
  content: unset;
}
.grid-responsive table .form-check-input:checked {
  background-color: #923600ff;
  border-color: #923600ff;
  border: 1px solid #923600ff;
}
.grid-responsive table .form-check-input:focus {
  border-color: #86b7fe;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(146, 54, 0, 0.25);
}
.grid-responsive table .form-check-input:checked {
  background-color: #923600ff;
  border-color: #923600ff;
}
.grid-responsive table .form-check-input[type=checkbox]:indeterminate {
  background-color: #923600ff;
  border-color: #923600ff;
}
.grid-responsive table thead > tr > th {
    background: #d45500ff;
    color: #fff;
}
.grid-responsive table thead > tr > th a {
    color: #fff;
    text-decoration: none;
}
.grid-responsive table thead > tr > td.sorting,
.grid-responsive table thead > tr > td.sorting_asc,
.grid-responsive table thead > tr > td.sorting_desc,
.grid-responsive table thead > tr > th.sorting,
.grid-responsive table thead > tr > th.sorting_asc,
.grid-responsive table thead > tr > th.sorting_desc {
    padding-right: 30px;
}
.grid-responsive table thead .sorting,
.grid-responsive table thead .sorting_asc,
.grid-responsive table thead .sorting_asc_disabled,
.grid-responsive table thead .sorting_desc,
.grid-responsive table thead .sorting_desc_disabled {
    cursor: pointer;
    position: relative;
}
.grid-responsive table thead .sorting:after,
.grid-responsive table thead .sorting:before,
.grid-responsive table thead .sorting_asc:after,
.grid-responsive table thead .sorting_asc:before,
.grid-responsive table thead .sorting_asc_disabled:after,
.grid-responsive table thead .sorting_asc_disabled:before,
.grid-responsive table thead .sorting_desc:after,
.grid-responsive table thead .sorting_desc:before,
.grid-responsive table thead .sorting_desc_disabled:after,
.grid-responsive table thead .sorting_desc_disabled:before {
    position: absolute;
    bottom: 0.9rem;
    display: block;
    margin: 0 -32px -14px 0px;
    opacity: 0.3;
}
.grid-responsive table thead .sorting:before,
.grid-responsive table thead .sorting_asc:before,
.grid-responsive table thead .sorting_asc_disabled:before,
.grid-responsive table thead .sorting_desc:before,
.grid-responsive table thead .sorting_desc_disabled:before {
    right: 1em;
    font-family: bootstrap-icons !important;
    content: "\2191";
}
.grid-responsive table thead .sorting:after,
.grid-responsive table thead .sorting_asc:after,
.grid-responsive table thead .sorting_asc_disabled:after,
.grid-responsive table thead .sorting_desc:after,
.grid-responsive table thead .sorting_desc_disabled:after {
    right: 0.5em;
    font-family: bootstrap-icons !important;
    content: "\2193";
}
.grid-responsive table thead .sorting_asc:before,
.grid-responsive table thead .sorting_desc:after {
    opacity: 1;
}
.grid-responsive table thead .sorting_asc_disabled:before,
.grid-responsive table thead .sorting_desc_disabled:after {
    opacity: 0;
}
.grid-responsive table.table-sm .sorting:before,
.grid-responsive table.table-sm .sorting_asc:before,
.grid-responsive table.table-sm .sorting_desc:before {
    top: 5px;
    right: 0.85em;
}
.grid-responsive table.table-sm .sorting:after,
.grid-responsive table.table-sm .sorting_asc:after,
.grid-responsive table.table-sm .sorting_desc:after {
    top: 5px;
}
.grid-responsive table td {
    position: relative;   
}
.grid-responsive table.nowrap td,
.grid-responsive table.nowrap th {
    white-space: nowrap;
}
.grid-responsive table thead > tr > td:active,
.grid-responsive table thead > tr > th:active {
    outline: 0;
}
.grid-responsive table tbody tr:hover th,
.grid-responsive table tbody tr:hover td {
    background-color: #ececf6;
    transition: all .2s;
}
.grid-responsive table td:empty,
.grid-responsive table th:empty {
    text-align: center;
}
.grid-responsive table a.grid-expand {
	color: #ba3600ff;
	display: block;
	position: absolute;
	right: 0;
	top: -5px;
	padding: 10px;
	display: none;
}
.grid-responsive table th .btn-group .btn {
  padding: 0 8px;
  /*font-size: 16px;*/
  font-weight: bold;
  text-align: right;
}
.grid-responsive table .toolbox {
	width: 70px;
    display: flex;
    gap: 10px;
}
.grid-responsive table .toolbox a {
    font-size: 10px;
}
.grid-responsive table .toolbox a.remove {
	float: left;
}
.grid-responsive table .toolbox a.update {
	float: left;
}
.grid-responsive ul.pagination {
    margin: 2px 0;
    white-space: nowrap;
    justify-content: flex-end;
}
.grid-responsive table tbody td:has(.empty) {
    display: table-cell;
}
@media screen and (max-width: 767px) {
    .grid-responsive table {
        width: 100%;
    }
    .grid-responsive .table > :not(caption) > * > * {
        padding: 0.25rem 0.5rem;
    }
    .grid-responsive table thead th.column-primary {
        width: 100%;
    }
    .grid-responsive table thead th:not(.column-primary) {
        display:none;
    }
    .grid-responsive table .title {
        text-transform: uppercase;
        font-weight: bold;
    }
    .grid-responsive table th[scope="row"] {
        vertical-align: top;
        cursor: pointer;
    }
    .grid-responsive table td {
        display: table-cell;
        width: auto;
    }
    .grid-responsive table td .grid-expand {
        display: block !important;
    }
    .grid-responsive table td:nth-child(n+3)::before {
        float: left;
        font-weight: bold;
        text-align: left;
        content: attr(data-header) " :";
        /*width: 80px;*/
        padding-right: 1rem;
    }
    .grid-responsive table td:nth-child(n+3)::after {
        clear: both;
        content: "";
        display: table;
    }
    .grid-responsive table tr.expanded td {
        display: block;
        width: auto;
    }
    .grid-responsive table tr.expanded td:nth-child(n+3) {
        display: flex;
        flex-direction: column;
    }
    .grid-responsive table tr.expanded td:nth-last-child(-n+1),
    .grid-responsive table tr.expanded td:nth-child(n+3):is(:nth-last-child(-n+1)),
    .grid-responsive table tr.expanded td:nth-child(n+3):is(:nth-last-child(-n+1))::after {
        padding-bottom: 16px!important;
    }
    .grid-responsive table td:nth-child(n+3) {
        display: none;
    }
    .grid-responsive table .toolbox {
        gap: 5px;
    }
}
.grid-responsive ul.pagination li a,
.grid-responsive table.table-hover tbody tr {
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -webkit-transition: all 0.2s ease-in-out;
}
.grid-responsive ul.pagination {
    border-radius: 3px;
    margin-top: 1rem;
    display: flex;
    padding-left: 0;
    list-style: none;    
}
.grid-responsive ul.pagination li a,
.grid-responsive ul.pagination li.disabled span {
    padding: 4px 10px;
    min-width: 30px;
    line-height: 20px;
    /*font-size: 12px;*/
    margin-left: 0;
    text-align: center;
    color: #323c47;
    border-color: #d7dde3;
    outline: 0;
    background: #fff;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease-in-out;
    text-decoration: none;
}
.grid-responsive ul.pagination li a:hover {
    background: #f2f2f2;
}
.grid-responsive ul.pagination li.active a {
    border-color: #fd7e14;
    background: #fd7e14;
    color: #fff;
}
.grid-responsive ul.pagination li.disabled:last-child {
    margin-left: 0;
}
.grid-responsive ul.pagination li:first-child a,
.grid-responsive ul.pagination li.disabled:first-child span {
    border-top-left-radius: 3px !important;
    border-bottom-left-radius: 3px !important;
}
.grid-responsive ul.pagination li:last-child a,
.grid-responsive ul.pagination li.disabled:last-child span {
    border-top-right-radius: 3px !important;
    border-bottom-right-radius: 3px !important;
}
.grid-responsive ul.pagination li.disabled > * {
    background-color: #e2e3e5;
}
.grid-responsive ul.pagination--space li a {
    margin-right: 5px;
}
.grid-responsive ul.pagination.pagination-lg li a {
    padding: 14px 15px;
    min-width: 50px;
    /*font-size: 13px;*/
}
.grid-responsive ul.pagination.pagination-sm li a {
    padding: 4px 10px;
    min-width: 30px;
    /*font-size: 12px;*/
}
.grid-responsive .summary {
    margin-top: 1.25rem;
}

@media screen and (max-width: 767px) {
    .grid-responsive .summary {
        text-align: center;
    }
    .grid-responsive ul.pagination {
        text-align: center;
        justify-content: center;
    }
}

div.dataTables_wrapper div.dataTables_info {
  display: none;
}
div.dataTables_wrapper div.dataTables_paginate {
  display: none;
}
table.dataTable.table-print {
  display: none;
}
div.dataTables_wrapper div.dataTables_filter {
  display: none;
}

.welcome-form-search {
  position: relative;
  box-shadow: 0 0 40px rgba(51, 51, 51, .1);
  width: 100%;
}

.welcome-form-search .input-search {
  height: 60px;
  width: 100%;
  display: block;
}

.welcome-form-search .btn-search {
  position: absolute;
  right: 0;
  top: 0;
  height: 58px;
  width: 58px;
}
    </style>
  </head>
  <body>
    <header class="navbar navbar-expand-lg navbar-light py-3 mb-4 border-bottom">
      <div class="container-fluid">
        <div class="navbar-wrapper d-flex justify-content-center">
          <div class="navbar-brand-group d-flex align-items-center justify-content-center order-lg-0 col-10 col-lg-auto">
            <button type="link" data-bs-toggle="collapse" data-bs-target="#navbarsTopMenu" class="btn d-block d-lg-none ms-0 ms-lg-3">
              <i class="bi bi-list"></i>
            </button>
            <a href="<?= create_url('/') ?>" class="navbar-brand link-body-emphasis text-decoration-none">
              <img src="<?= create_url('resources/images/bucumi-logo.webp') ?>" class="ms-0 ms-lg-3" width="130" height="32">
            </a>
          </div>
          <div class="nav-user-info flex-shrink-1 order-lg-2 me-0 me-lg-3 dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle mt-1" data-bs-toggle="dropdown" aria-expanded="false">
              <?php if (!bucumi_auth()): ?>
                <img src="<?= create_url('resources/images/guest-avatar-100.png') ?>" alt="Guest" width="32" height="32" class="rounded-circle">
                <?php else: ?>
                  <img src="<?= create_assetlink('avatars/'. (!empty($authUser['userphoto']) ? $authUser['userphoto'] : 'default.jpg')) ?>" alt="<?= $authUser['username'] ?>" width="32" height="32" class="rounded-circle">
                <?php endif; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow">
              <?php if (!bucumi_auth()): ?>
                <li><a class="dropdown-item" href="<?= create_url('login') ?>">Login</a></li>
                <li><a class="dropdown-item" href="<?= create_url('register') ?>">Register</a></li>
              <?php else: ?>
                <li><h6 class="dropdown-header">Hi.. <?=  ucfirst($authUser['username'] ?? 'guest') ?></h6></li>
                <li><a class="dropdown-item" href="<?= create_url('topup') ?>">Saldo: Rp <?= number_format($authUser['userbalance'],0,',','.') ?></a></li>
                <li><a class="dropdown-item" href="<?= create_url($authUser['username']) ?>">Lihat Profil</a></li>
                <?php if ($authUser['userrole']=='admin'): ?>
                  <li><a class="dropdown-item" href="<?= create_url('user/manage') ?>">Daftar Pengguna</a></li>
                <?php endif; ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?= create_url('logout') ?>">Logout</a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="collapse navbar-collapse order-lg-1 pt-2 pt-lg-0" id="navbarsTopMenu">
            <ul class="navbar-nav nav col-12 col-lg-auto me-lg-auto justify-content-center pb-2 pb-lg-0">
            <li class="nav-item"><a href="<?= create_url('catalog') ?>" class="nav-link px-2 link-body-emphasis">Katalog</a></li>
              <?php if (bucumi_auth()): ?>                
                <?php if ($authUser['userrole']=='admin'): ?>
                  <li class="nav-item dropdown">
                      <a href="javascript:void()" class="nav-link dropdown-toggle px-2 link-body-emphasis" data-bs-toggle="dropdown">Layanan</a>
                      <ul class="dropdown-menu">
                        <li><a href="<?= create_url('book/manage') ?>" class="dropdown-item px-2 link-body-emphasis">Daftar Buku</a></li>
                        <li><a href="<?= create_url('member/manage') ?>" class="dropdown-item px-2 link-body-emphasis">Daftar Anggota</a></li>
                      </ul>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
              <li class="nav-item"><a href="<?= create_url('about') ?>" class="nav-link px-2 link-body-emphasis">Tentang</a></li>
            </ul>
            <form action="<?= create_url('catalog') ?>" method="GET" class="form-search col-12 col-lg-auto me-lg-3" role="search">
              <input name="search" type="search" class="form-control form-control-light text-bg-light" placeholder="Cari Buku..." aria-label="Search">
              <button type="submit" class="btn btn-search position-absolute"><i class="bi bi-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </header>
    <main class="container py-3">