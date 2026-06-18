import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';
import 'character_model.dart';

class DatabaseHelper {
  static final DatabaseHelper instance = DatabaseHelper._init();
  static Database? _database;

  DatabaseHelper._init();

  Future<Database> get database async {
    if (_database != null) return _database!;
    _database = await _initDB('characters.db');
    return _database!;
  }

  Future<Database> _initDB(String filePath) async {
    final dbPath = await getDatabasesPath();
    final path = join(dbPath, filePath);

    return await openDatabase(path, version: 1, onCreate: _createDB);
  }

  Future _createDB(Database db, int version) async {
    await db.execute('''
      CREATE TABLE characters (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        username TEXT NOT NULL
      )
    ''');
  }

  Future<void> insertCharacter(Character character) async {
    final db = await instance.database;
    await db.insert(
      'characters',
      character.toMap(),
      conflictAlgorithm: ConflictAlgorithm.replace,
    );
  }

  Future<List<Character>> getAllCharacters() async {
    final db = await instance.database;
    final maps = await db.query('characters');

    return maps.map((map) => Character.fromMap(map)).toList();
  }

  Future<void> clearTable() async {
    final db = await instance.database;
    await db.delete('characters');
  }
}
