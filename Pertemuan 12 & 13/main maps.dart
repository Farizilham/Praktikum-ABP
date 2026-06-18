import 'package:flutter/material.dart';
import 'package:flutter_map/flutter_map.dart';
import 'package:latlong2/latlong.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: PlacePickerMapPage(),
    );
  }
}

class PlacePickerMapPage extends StatefulWidget {
  const PlacePickerMapPage({super.key});

  @override
  State<PlacePickerMapPage> createState() => _PlacePickerMapPageState();
}

class _PlacePickerMapPageState extends State<PlacePickerMapPage> {
  final LatLng initialLocation = LatLng(-6.9733165, 107.6281415);

  LatLng? selectedLocation;

  @override
  void initState() {
    super.initState();
    selectedLocation = initialLocation;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('OpenStreetMap Place Picker'),
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,
      ),
      body: Stack(
        children: [
          FlutterMap(
            options: MapOptions(
              initialCenter: initialLocation,
              initialZoom: 15,
              onTap: (tapPosition, point) {
                setState(() {
                  selectedLocation = point;
                });
              },
            ),
            children: [
              TileLayer(
                urlTemplate: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                userAgentPackageName: 'com.example.praktik_maps',
              ),

              MarkerLayer(
                markers: [
                  Marker(
                    point: initialLocation,
                    width: 80,
                    height: 80,
                    child: const Icon(
                      Icons.location_pin,
                      color: Colors.red,
                      size: 45,
                    ),
                  ),

                  if (selectedLocation != null)
                    Marker(
                      point: selectedLocation!,
                      width: 80,
                      height: 80,
                      child: const Icon(
                        Icons.place,
                        color: Colors.blue,
                        size: 45,
                      ),
                    ),
                ],
              ),
            ],
          ),

          Positioned(
            left: 16,
            right: 16,
            bottom: 20,
            child: Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(16),
                boxShadow: const [
                  BoxShadow(blurRadius: 8, color: Colors.black26),
                ],
              ),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Text(
                    'Lokasi yang Dipilih',
                    style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                  ),

                  const SizedBox(height: 8),

                  Text(
                    'Latitude: ${selectedLocation!.latitude}',
                    style: const TextStyle(fontSize: 14),
                  ),

                  Text(
                    'Longitude: ${selectedLocation!.longitude}',
                    style: const TextStyle(fontSize: 14),
                  ),

                  const SizedBox(height: 12),

                  SizedBox(
                    width: double.infinity,
                    child: ElevatedButton(
                      onPressed: () {
                        ScaffoldMessenger.of(context).showSnackBar(
                          SnackBar(
                            content: Text(
                              'Lokasi dipilih: ${selectedLocation!.latitude}, ${selectedLocation!.longitude}',
                            ),
                          ),
                        );
                      },
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.green,
                        foregroundColor: Colors.white,
                      ),
                      child: const Text('Pilih Lokasi Ini'),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
