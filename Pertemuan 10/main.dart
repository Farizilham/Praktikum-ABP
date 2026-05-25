import 'dart:async';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'models/new_screen.dart';

void main() => runApp(
  MaterialApp(
    theme: ThemeData(
      appBarTheme: const AppBarTheme(backgroundColor: Colors.amber),
    ),
    debugShowCheckedModeBanner: false,
    home: const MyApp(),
  ),
);

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  // Inisialisasi object untuk notifikasi lokal
  FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin =
      FlutterLocalNotificationsPlugin();

  @override
  void initState() {
    super.initState();

    // Pengaturan notifikasi Android menggunakan icon bawaan (ic_launcher)
    var initializationSettingsAndroid = const AndroidInitializationSettings(
      '@mipmap/ic_launcher',
    );

    // PERUBAHAN 1: IOSInitializationSettings diganti menjadi DarwinInitializationSettings
    var initializationSettingsIOS = const DarwinInitializationSettings();

    var initSettings = InitializationSettings(
      android: initializationSettingsAndroid,
      iOS: initializationSettingsIOS,
    );

    // PERUBAHAN 2: onSelectNotification diganti dengan onDidReceiveNotificationResponse sesuai versi 14+
    flutterLocalNotificationsPlugin.initialize(
      initSettings,
      onDidReceiveNotificationResponse:
          (NotificationResponse notificationResponse) async {
            String? payload = notificationResponse.payload;
            if (payload != null) {
              if (mounted) {
                Navigator.of(context).push(
                  MaterialPageRoute(
                    builder: (_) {
                      return NewScreen(payload: payload);
                    },
                  ),
                );
              }
            }
          },
    );
  }

  // Fungsi untuk memicu/menampilkan notifikasi
  Future<void> showNotification() async {
    // PERUBAHAN 3: Deskripsi harus didefinisikan lewat parameter 'channelDescription'
    var android = const AndroidNotificationDetails(
      'id',
      'channel_name',
      channelDescription: 'description',
      priority: Priority.high,
      importance: Importance.max,
    );

    // PERUBAHAN 1: IOSNotificationDetails diganti menjadi DarwinNotificationDetails
    var iOS = const DarwinNotificationDetails();
    var platform = NotificationDetails(android: android, iOS: iOS);

    await flutterLocalNotificationsPlugin.show(
      0,
      'Pemberitahuan Baru',
      'Klik untuk pindah halaman dan mengirim data payload',
      platform,
      payload: 'Welcome to Local Notification Demo', // Data yang dikirim
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Modul 7: Navigasi & Notifikasi')),
      body: Center(
        child: ElevatedButton(
          style: ElevatedButton.styleFrom(backgroundColor: Colors.blueAccent),
          onPressed: showNotification,
          child: const Text(
            'Kirim Notifikasi',
            style: TextStyle(color: Colors.white),
          ),
        ),
      ),
    );
  }
}
