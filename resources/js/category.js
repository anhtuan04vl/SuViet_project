import axios from 'axios';
import Swal from 'sweetalert2';


document.querySelectorAll('.toggle-status').forEach((checkbox) => {
    checkbox.addEventListener('change', function () {
        const categoryId = this.dataset.id;
        const isActive = this.checked ? 1 : 0;

        axios.post('/admin/update-category-status', {
            id_category: categoryId,  // Gửi id_category thay vì id
            is_active: isActive
        })
        .then(response => {
            // Hiển thị thông báo thành công với SweetAlert2
            Swal.fire({
                title: 'Thành công!',
                text: response.data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        })
        .catch(error => {
            // Kiểm tra lỗi nếu sản phẩm tồn tại trong danh mục
            if (error.response && error.response.status === 400) {
                Swal.fire({
                    title: 'Lỗi!',
                    text: error.response.data.message || 'Sản phẩm tồn tại trong danh mục, không thể ẩn!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                // Trả lại checkbox về trạng thái ban đầu (tùy chọn)
                this.checked = !this.checked;
            } else {
                // Hiển thị thông báo thành công với SweetAlert2
            Swal.fire({
                title: 'Đã có lỗi xảy ra!',
                text: 'vui lòng thử lại',
                icon: 'error',
                confirmButtonText: 'OK'
            });
                console.error('Lỗi:', error.response ? error.response.data.message : error.message);
            }
        });
    });
});

