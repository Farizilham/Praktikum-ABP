# SET UP NOTIFICATION ANDROID

---

### Langkah 1: Tambahkan Package

Buka terminal di _root_ (folder utama) proyek Flutter Anda, lalu jalankan perintah ini untuk menginstal _package_ secara otomatis:

```bash
flutter pub add flutter_local_notifications

```

Atau, Anda bisa menambahkannya secara manual di file `pubspec.yaml`:

```yaml
dependencies:
  flutter:
    sdk: flutter
  flutter_local_notifications: ^17.0.0 # Gunakan versi terbaru
```

### Langkah 2: Beri Izin di Android Manifest

Mulai Android 13 (API Level 33), aplikasi wajib meminta izin untuk memunculkan notifikasi.

Buka file `android/app/src/main/AndroidManifest.xml`, lalu tambahkan dua baris `uses-permission` ini tepat **di atas** tag `<application>`:

````xml
<manifest xmlns:android="http://schemas.android.com/apk/res/android">

    <uses-permission android:name="android.permission.POST_NOTIFICATIONS" />
    <uses-permission android:name="android.permission.VIBRATE" />

    <application
        android:label="nama_aplikasi"
        android:name="${applicationName}"
        android:icon="@mipmap/ic_launcher">
        ```

### Langkah 3: Setup Core Library Desugaring (Wajib untuk Java 8+)
Karena *package* versi terbaru menggunakan fitur Java 8, kita harus mengaktifkan *desugaring*. Buka file konfigurasi Gradle level aplikasi Anda di 📁 `android/app/build.gradle.kts`.

**A. Aktifkan Fitur Desugaring**
Cari blok `android { ... }` lalu di dalamnya cari blok `compileOptions`. Tambahkan pengaturan desugaring dengan **huruf C kapital**:
```kotlin
android {
    // ... pengaturan lain ...

    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_1_8
        targetCompatibility = JavaVersion.VERSION_1_8

        // Tambahkan baris ini secara hati-hati (perhatikan huruf besarnya):
        isCoreLibraryDesugaringEnabled = true
    }
}

````

**B. Tambahkan Dependency Desugaring**
Scroll ke baris paling bawah pada file `build.gradle.kts` tersebut (di luar blok `android`). Jika belum ada blok `dependencies`, buat sendiri:

```kotlin
// Letakkan ini di baris paling bawah file
dependencies {
    coreLibraryDesugaring("com.android.tools:desugar_jdk_libs:2.1.4")
}

```

Enable juga library desugaringnya

```kotlin
    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_17
        targetCompatibility = JavaVersion.VERSION_17
        //tambahkan line ini
        isCoreLibraryDesugaringEnabled = true
    }

```

---

# SET UP MAPS

Buka terminal di VS Code (atau PowerShell) dan jalankan:

```bash
flutter pub add firebase_core
flutter pub add firebase_messaging

```

---

# SET UP FIREBASE NOTIFICATION

Cara manual (tanpa CLI) ini adalah metode klasik yang sangat baik untuk dipelajari karena membuat Anda lebih memahami bagaimana Firebase sebenarnya terhubung ke sistem Android di bawah layar.

Berikut adalah langkah-langkah membuat project Firebase Notifikasi dengan cara mengunduh file `google-services.json`.

---

### **Langkah 1: Menyiapkan Project di Firebase Console**

1. Buka [Firebase Console](https://console.firebase.google.com/) dan klik **Add project** (Buat project baru).
2. Beri nama project (misal: `PraktikumNotif`), lalu klik **Continue**.
3. lalu klik **Create project**.
4. Setelah project selesai dibuat, di halaman utama (Project Overview), klik ikon **Android** untuk menambahkan aplikasi Android.

### **Langkah 2: Mendaftarkan Aplikasi & Mengunduh JSON**

Di halaman pendaftaran aplikasi Android pada Firebase:

1. **Android package name:** Ini harus sama persis dengan ID aplikasi Anda.

- Buka file `android/app/build.gradle` di project Flutter Anda.
- Cari baris `applicationId` (biasanya berupa `"com.example.nama_project"`). Copy dan paste ke Firebase.

2. Klik **Register app**.
3. Klik tombol **Download google-services.json**.
4. Pindahkan file `google-services.json` yang baru saja diunduh ke dalam folder `android/app/` di project Flutter Anda. _(Pastikan namanya tepat `google-services.json`, tidak ada tambahan angka seperti `(1)`)._
5. Di web Firebase, klik **Next** sampai selesai (Continue to console). Kita akan melakukan konfigurasi Gradle secara manual di langkah selanjutnya.

---

### **Langkah 3: Konfigurasi File Gradle Android**

Ini adalah langkah krusial pengganti FlutterFire CLI. Anda perlu mengedit dua file Gradle.

**1. Buka `android/settings.gradlee` (Project-level)**
Cari blok `dependencies` (biasanya di dalam blok `buildscript`) atau buat jika belum ada dan tambahkan _classpath_ Google Services:

```gradle
buildscript {
    // ... konfigurasi lainnya ...
    dependencies {
        // Tambahkan baris ini:
        classpath 'com.google.gms:google-services:4.4.1'
    }
}

```

**2. Buka `android/app/build.gradle` (App-level)**
Scroll ke bagian paling bawah file tersebut, lalu tambahkan baris ini untuk mengaktifkan plugin:

```gradle
// Tambahkan di baris paling bawah
apply plugin: 'com.google.gms.google-services'

```

---

### **Langkah 4: Instalasi Dependensi di Flutter**

Buka terminal di VS Code (atau PowerShell) dan jalankan:

```bash
flutter pub add firebase_core
flutter pub add firebase_messaging

```

---

### **Langkah 5: Menulis Kode Dart (`main.dart`)**

Perbedaan utama kode ini dengan versi CLI adalah kita **tidak memerlukan** file `firebase_options.dart`. Pada Android, perintah `Firebase.initializeApp()` akan secara otomatis membaca konfigurasi dari file `google-services.json` yang sudah Anda letakkan tadi.

Timpa file `lib/main.dart` Anda dengan kode yang ada di folder firebase_notification di repository ini:

### **Langkah 6: Jalankan dan Test**

1. Jalankan Project menggunakan run & Debug
2. Salin token yang muncul di layar.
3. Buka **Firebase Console** -> Menu **Messaging** (di bawah Engage) -> **Create your first campaign** -> **Firebase Notification messages**.
4. Isi judul dan pesan, lalu klik **Send test message** di sebelah kanan.
5. Masukkan token Anda, lalu klik **Test**.

---
