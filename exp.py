import pyrebase

config = {
  "apiKey": "AIzaSyA-9hvgL8PCZs7CVwZVawZ-U3ob69QSaH4",
  "authDomain": "network-manager-7d73f.firebaseapp.com",
  "databaseURL": "https://network-manager-7d73f.firebaseio.com",
  "storageBucket": "network-manager-7d73f.appspot.com",
}

firebase = pyrebase.initialize_app(config)

db = firebase.database()

print(db.get())
