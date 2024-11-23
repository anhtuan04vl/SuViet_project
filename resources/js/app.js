import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import axios from 'axios';


axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Kiểm tra Axios hoạt động chưa
console.log('Axios loaded successfully!');

import Swal from 'sweetalert2';

// Swal.fire({
//     title: 'Thành công!',
//     text: 'Thêm danh mục thành công.',
//     icon: 'success',
//     confirmButtonText: 'Đóng'
// });
// Swal.fire({
//     title: 'Lỗi!',
//     text: 'Sản phẩm tồn tại trong danh mục, không thể ản!',
//     icon: 'error',
//     confirmButtonText: 'OK'
// });
// Swal.fire({
//     title: 'Đã có lỗi xảy ra!',
//     text: 'vui lòng thử lại',
//     icon: 'warning',
//     confirmButtonText: 'OK'
// });