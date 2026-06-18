class Character {
  final int id;
  final String name;
  final String username;

  Character({required this.id, required this.name, required this.username});

  factory Character.fromMap(Map<String, dynamic> map) {
    return Character(
      id: map['id'],
      name: map['name'],
      username: map['username'] ?? 'Unknown Username',
    );
  }

  Map<String, dynamic> toMap() {
    return {'id': id, 'name': name, 'username': username};
  }
}
