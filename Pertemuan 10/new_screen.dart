import 'package:flutter/material.dart';

class NewScreen extends StatelessWidget {
  final String payload;

  // Constructor menerima data (payload) dari halaman sebelumnya
  const NewScreen({super.key, required this.payload});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(payload), // Menampilkan data yang dikirimkan
      ),
      body: Center(
        child: ElevatedButton(
          onPressed: () {
            // Perintah Navigasi untuk kembali ke halaman sebelumnya
            Navigator.pop(context);
          },
          child: const Text('Kembali'),
        ),
      ),
    );
  }
}
