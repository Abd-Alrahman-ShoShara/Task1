# tasksManger
to do list in laravel and js and html and css for the task1 
# Task Manager API & Frontend Interface

مشروع إدارة المهام باستخدام Laravel 10 وBlade، يتيح للمستخدمين عرض، إضافة، حذف، وتصنيف المهام عبر واجهة رسومية تفاعلية باستخدام JavaScript وAJAX.

 الهدف

توفير نظام بسيط وحديث لإدارة المهام، مع فصل واضح بين منطق الأعمال (Business Logic) والتعامل مع البيانات، باستخدام أفضل ممارسات Laravel من حيث التنظيم والكتابة النظيفة.

---

 المعمارية والتنظيم

تم تنظيم المشروع وفقًا لمبدأ **Separation of Concerns**، من خلال الطبقات التالية:

### ✅ Laravel 10 + API Resource Controllers

- تم استخدام **Resource Controllers** لبناء RESTful API مخصصة لإدارة المهام والتصنيفات.
- كل Controller مسؤول فقط عن التعامل مع الـ HTTP Requests، وتفويض المنطق المعقد إلى الطبقات الأخرى.

###  الطبقات الأساسية (Layers)

- **Controllers**: التعامل مع الطلبات والاستجابات.
- **Services**: منطق الأعمال (Business Logic) مثل إنشاء أو تعديل المهام.
- **Repositories**: الوصول إلى البيانات من خلال Eloquent أو استعلامات مخصصة.
- **Models**: تمثل الجداول في قاعدة البيانات وتُستخدم لتحديد العلاقات.

###  استخدام DTOs (Data Transfer Objects)

- تُستخدم لنقل البيانات بشكل واضح وآمن بين الطبقات، وتسهيل اختبار الطبقات المختلفة بدون الاعتماد على الكائنات الضخمة.

###  استخدام Form Requests

- لفصل منطق التحقق من صحة البيانات عن الـ Controllers.
- التحقق من صحة البيانات يتم تلقائيًا قبل تنفيذ المنطق داخل Controller.
- أمثلة: `StoreTaskRequest`, `UpdateTaskRequest`.

---

##  واجهة المستخدم (Frontend)

- تم تطويرها باستخدام Blade وJavaScript النقي (Vanilla JS).
- تتعامل مباشرة مع API عبر Fetch وAJAX.
- واجهة تفاعلية تحتوي على:
  - جدول عرض المهام.
  - نموذج إضافة مهمة جديدة.
  - تحميل ديناميكي للتصنيفات عبر API.
  - حذف المهام مباشرة من الجدول.

---

##  مميزات إضافية

- مصادقة باستخدام Laravel Sanctum (JWT أو Token-based authentication).
- حماية كاملة للروابط الحساسة.
- دعم لتعدد المستخدمين وامتلاكهم للمهام والتصنيفات الخاصة.

---

##  هيكل المشروع

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   ├── Resources/
│   └── Middleware/
├── Models/
├── Services/
├── Repositories/
database/
├── migrations/
├── seeders/
routes/
├── api.php
├── web.php
resources/
├── views/
└── js/
