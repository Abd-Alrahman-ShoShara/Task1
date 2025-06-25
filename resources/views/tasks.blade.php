<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مهامي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .task-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .task-completed {
            border-left-color: #10b981;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        }
        .task-pending {
            border-left-color: #f59e0b;
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        }
        .modal-overlay {
            backdrop-filter: blur(5px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        .btn-logout {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        .btn-logout:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
        }
        .category-tag {
            background: linear-gradient(135deg, #ddd6fe 0%, #c4b5fd 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto p-6 max-w-6xl">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">مهامي</h1>
                    <p class="text-gray-600">إدارة وتنظيم مهامك اليومية</p>
                </div>
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div id="stats" class="flex space-x-6 space-x-reverse text-center">
                        <div class="bg-green-100 px-4 py-2 rounded-lg">
                            <div class="text-2xl font-bold text-green-600" id="completed-count">0</div>
                            <div class="text-sm text-green-700">مكتملة</div>
                        </div>
                        <div class="bg-yellow-100 px-4 py-2 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600" id="pending-count">0</div>
                            <div class="text-sm text-yellow-700">قيد التنفيذ</div>
                        </div>
                    </div>
                    <button onclick="openAddTaskModal()" class="btn-primary text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                        <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة مهمة جديدة
                    </button>
                    <button onclick="logout()" class="btn-logout text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                        <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        تسجيل الخروج
                    </button>
                </div>
            </div>
        </div>

        <!-- Tasks Grid -->
        <div id="tasks-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- سيتم ملء البطاقات هنا -->
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-12">
            <div class="bg-white rounded-2xl shadow-lg p-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">لا توجد مهام بعد</h3>
                <p class="text-gray-500 mb-6">ابدأ بإضافة مهمتك الأولى لتنظيم يومك</p>
                <button onclick="openAddTaskModal()" class="btn-primary text-white px-6 py-3 rounded-xl font-semibold">
                    إضافة مهمة الآن
                </button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Task Modal -->
    <div id="task-modal" class="hidden fixed inset-0 z-50 modal-overlay bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h3 id="modal-title" class="text-xl font-bold text-gray-800">مهمة جديدة</h3>
                    <button onclick="closeTaskModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <form id="task-form" class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">عنوان المهمة</label>
                    <input type="text" id="task-title" class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-blue-500 focus:outline-none transition-colors" placeholder="أدخل عنوان المهمة" required>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">وصف المهمة</label>
                    <textarea id="task-description" rows="4" class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-blue-500 focus:outline-none transition-colors resize-none" placeholder="أدخل وصف المهمة" required></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">حالة المهمة</label>
                    <select id="task-status" class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-blue-500 focus:outline-none transition-colors">
                        <option value="0">قيد التنفيذ</option>
                        <option value="1">مكتملة</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">التصنيفات</label>
                    <div id="categories-list" class="space-y-2 max-h-32 overflow-y-auto">
                        <!-- سيتم ملء التصنيفات هنا -->
                    </div>
                </div>
                
                <div class="flex space-x-3 space-x-reverse pt-4">
                    <button type="submit" class="flex-1 btn-primary text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                        حفظ المهمة
                    </button>
                    <button type="button" onclick="closeTaskModal()" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 z-50 modal-overlay bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full">
            <div class="p-6 text-center">
                <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">حذف المهمة</h3>
                <p class="text-gray-600 mb-6">هل أنت متأكد من حذف هذه المهمة؟ لا يمكن استرجاعها بعد الحذف.</p>
                <div class="flex space-x-3 space-x-reverse">
                    <button onclick="confirmDelete()" class="flex-1 bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                        حذف
                    </button>
                    <button onclick="closeDeleteModal()" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        إلغاء
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentEditingTaskId = null;
        let taskToDelete = null;

        // تسجيل الخروج
        async function logout() {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            try {
                const res = await fetch('/api/auth/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                // حذف الـ token من localStorage بغض النظر عن نتيجة الطلب
                localStorage.removeItem('token');
                
                // إعادة التوجيه إلى صفحة تسجيل الدخول
                window.location.href = '/login';
                
            } catch (error) {
                console.error('خطأ في تسجيل الخروج:', error);
                // حذف الـ token والتوجيه حتى لو فشل الطلب
                localStorage.removeItem('token');
                window.location.href = '/login';
            }
        }

        // تحميل المهام وعرضها
        async function fetchTasks() {
            const token = localStorage.getItem('token');
            if (!token) {
                alert('الرجاء تسجيل الدخول أولاً');
                window.location.href = '/login';
                return;
            }

            try {
                const res = await fetch('/api/tasks', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!res.ok) {
                    throw new Error('فشل في جلب المهام');
                }

                const tasks = await res.json();
                displayTasks(tasks);
                updateStats(tasks);
            } catch (error) {
                console.error('فشل في جلب المهام:', error);
                showError('حدث خطأ أثناء جلب المهام');
            }
        }

        // عرض المهام في البطاقات
        function displayTasks(tasks) {
            const container = document.getElementById('tasks-container');
            const emptyState = document.getElementById('empty-state');

            if (tasks.length === 0) {
                container.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            container.innerHTML = tasks.map(task => createTaskCard(task)).join('');
        }

        // إنشاء بطاقة مهمة
        function createTaskCard(task) {
            const isCompleted = task.is_completed;
            const statusClass = isCompleted ? 'task-completed' : 'task-pending';
            const statusText = isCompleted ? 'مكتملة' : 'قيد التنفيذ';
            const statusIcon = isCompleted ? 
                `<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>` :
                `<svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`;

            return `
                <div class="task-card ${statusClass} bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-2 space-x-reverse">
                            ${statusIcon}
                            <span class="text-sm font-semibold ${isCompleted ? 'text-green-700' : 'text-yellow-700'}">${statusText}</span>
                        </div>
                        <div class="flex space-x-2 space-x-reverse">
                            <button onclick="editTask(${task.id})" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="تعديل">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="showDeleteModal(${task.id})" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors" title="حذف">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight">${task.title}</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">${task.description}</p>
                    
                    <div class="flex flex-wrap gap-2">
                        ${task.categories.map(cat => 
                            `<span class="category-tag text-purple-800 px-3 py-1 rounded-full text-xs font-medium">${cat.name}</span>`
                        ).join('')}
                    </div>
                </div>
            `;
        }

        // تحديث الإحصائيات
        function updateStats(tasks) {
            const completed = tasks.filter(task => task.is_completed).length;
            const pending = tasks.filter(task => !task.is_completed).length;
            
            document.getElementById('completed-count').textContent = completed;
            document.getElementById('pending-count').textContent = pending;
        }

        // فتح نافذة إضافة مهمة
        async function openAddTaskModal() {
            currentEditingTaskId = null;
            document.getElementById('modal-title').textContent = 'مهمة جديدة';
            document.getElementById('task-form').reset();
            await loadCategories();
            document.getElementById('task-modal').classList.remove('hidden');
        }

        // فتح نافذة تعديل مهمة
        async function editTask(id) {
            currentEditingTaskId = id;
            document.getElementById('modal-title').textContent = 'تعديل المهمة';
            
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/tasks', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                
                const tasks = await res.json();
                const task = tasks.find(t => t.id === id);
                
                if (task) {
                    document.getElementById('task-title').value = task.title;
                    document.getElementById('task-description').value = task.description;
                    document.getElementById('task-status').value = task.is_completed ? '1' : '0';
                    
                    await loadCategories();
                    
                    // تحديد التصنيفات المحددة
                    task.categories.forEach(cat => {
                        const checkbox = document.querySelector(`input[value="${cat.id}"]`);
                        if (checkbox) checkbox.checked = true;
                    });
                    
                    document.getElementById('task-modal').classList.remove('hidden');
                }
            } catch (error) {
                showError('فشل في جلب بيانات المهمة');
            }
        }

        // إغلاق نافذة المهمة
        function closeTaskModal() {
            document.getElementById('task-modal').classList.add('hidden');
            document.getElementById('task-form').reset();
        }

        // تحميل التصنيفات
        async function loadCategories() {
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/categories', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();
                const categories = data.Categories || [];
                
                const container = document.getElementById('categories-list');
                container.innerHTML = categories.map(cat => `
                    <label class="flex items-center space-x-3 space-x-reverse p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                        <input type="checkbox" value="${cat.id}" class="w-4 h-4 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">${cat.name}</span>
                    </label>
                `).join('');
            } catch (error) {
                showError('فشل في تحميل التصنيفات');
            }
        }

        // حفظ المهمة
        document.getElementById('task-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const title = document.getElementById('task-title').value.trim();
            const description = document.getElementById('task-description').value.trim();
            const is_completed = document.getElementById('task-status').value === '1';
            
            const checkboxes = document.querySelectorAll('#categories-list input[type=checkbox]:checked');
            const category_ids = Array.from(checkboxes).map(cb => parseInt(cb.value));

            if (!title || !description) {
                showError('يرجى تعبئة جميع الحقول المطلوبة');
                return;
            }

            if (category_ids.length === 0) {
                showError('يرجى اختيار تصنيف واحد على الأقل');
                return;
            }

            const token = localStorage.getItem('token');
            const url = currentEditingTaskId ? `/api/updateTasks/${currentEditingTaskId}` : '/api/addtasks';
            const method = currentEditingTaskId ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        title,
                        description,
                        is_completed,
                        category_ids
                    })
                });

                if (res.ok) {
                    showSuccess(currentEditingTaskId ? 'تم تحديث المهمة بنجاح' : 'تمت إضافة المهمة بنجاح');
                    closeTaskModal();
                    fetchTasks();
                } else {
                    const errorData = await res.json();
                    showError('فشل في حفظ المهمة: ' + (errorData.message || 'خطأ غير معروف'));
                }
            } catch (error) {
                showError('حدث خطأ أثناء الاتصال بالسيرفر');
            }
        });

        // إظهار نافذة الحذف
        function showDeleteModal(id) {
            taskToDelete = id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        // إغلاق نافذة الحذف
        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            taskToDelete = null;
        }

        // تأكيد الحذف
        async function confirmDelete() {
            if (!taskToDelete) return;

            const token = localStorage.getItem('token');
            try {
                const res = await fetch(`/api/deleteTasks/${taskToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (res.ok) {
                    showSuccess('تم حذف المهمة بنجاح');
                    closeDeleteModal();
                    fetchTasks();
                } else {
                    showError('فشل في حذف المهمة');
                }
            } catch (error) {
                showError('حدث خطأ أثناء الاتصال بالسيرفر');
            }
        }

        // عرض رسائل النجاح والخطأ
        function showSuccess(message) {
            // يمكنك استخدام مكتبة Toast أو إنشاء إشعارات مخصصة
            alert(message);
        }

        function showError(message) {
            alert(message);
        }

        // تحميل المهام عند فتح الصفحة
        fetchTasks();
    </script>
</body>
</html>