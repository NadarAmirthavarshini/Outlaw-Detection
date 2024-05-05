from tkinter import *
import tkinter as tk
import mysql.connector
from functools import partial
from PIL import Image, ImageTk
import cv2
import face_recognition
from pygame import mixer
import os
import shutil
import random
import threading


# faceCascade = cv2.CascadeClassifier("haarcascade_frontalface_default.xml")
mixer.init()
class CameraApp:
    def __init__(self, window, window_title):
        self.window = window
        self.window.title(window_title)

        # Create a button
        self.btn_snapshot = tk.Button(window, text="Capture", width=20, command=self.snapshot)
        self.btn_snapshot.pack(anchor=tk.CENTER, expand=True)

        # Open the camera
        self.cap = cv2.VideoCapture(0)
        self.video_display = tk.Label(window)
        self.video_display.pack(anchor=tk.CENTER, expand=True)

        self.update_camera()

        self.window.mainloop()


    def update_camera(self):
        ret, frame = self.cap.read()
        if ret:
            self.photo = ImageTk.PhotoImage(image=Image.fromarray(cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)))
            self.video_display.config(image=self.photo)
            self.video_display.image = self.photo
            self.window.after(10, self.update_camera)

    def play_sound(self,suspect):
        alert=tk.Tk()
        alert.title("Alert")

        suspect_name=str(suspect[1])
        msg="This is an alert! Suspect " + suspect_name + " has been found"
        label=tk.Label(alert,text=msg)
        label.pack()
        button=tk.Button(alert,text="Close",command=lambda: alert.destroy())
        button.pack()
        print("Playing sound")
        mixer.music.load('alarm.wav')
        mixer.music.play()
        alert.mainloop()

    def snapshot(self):
        ret, frame = self.cap.read()
        if ret:
            cv2.imwrite("snapshot.jpg", frame)
            print("Snapshot taken!")
            folder_path = "C:\\xampp\\htdocs\\Laravel\\Outlaws_Detection\\storage\\app\\public\\uploads\\suspect"
            image_encodings = []

            for filename in image_names:
                # for filename in os.listdir(folder_path):
                print(filename)
                image_path = os.path.join(folder_path, filename)
                image = face_recognition.load_image_file(image_path)
                try:
                    face_encoding = face_recognition.face_encodings(image)[0]
                    image_encodings.append(face_encoding)
                    # print(image_encodings)
                except IndexError:
                    print(f"No face detected in {filename}. Skipping...")

            # Load unknown image
            unknown_image = face_recognition.load_image_file("snapshot.jpg")
            try:
                unknown_face_encoding = face_recognition.face_encodings(unknown_image)[0]
            except IndexError:
                print("No face detected. Please click Again")
                alert=tk.Tk()
                alert.title("Alert")
                msg="No face detected. Please click Again"
                label=tk.Label(alert,text=msg)
                label.pack()
                button=tk.Button(alert,text="Close",command=lambda: alert.destroy())
                button.pack()
                alert.mainloop()
            # Compare faces
            results=face_recognition.face_distance(image_encodings,unknown_face_encoding)
            print(results)
            min=results.min()
            # Compare faces
            # results = face_recognition.compare_faces(image_encodings, unknown_face_encoding,.6)
            threshold=.6
            found_suspect=""
            # Check results
            isNotSuspect = True
            for i,result in enumerate(results):
                if result < threshold and result == min:
                    found_suspect=image_names[i]
                    print("Match found with image",found_suspect)
                    sql="SELECT * FROM suspect WHERE image_name = %s"
                    cursor.execute(sql,[found_suspect])
                    suspect=cursor.fetchone()
                    if (suspect):
                        isNotSuspect = False
                        suspect_id=suspect[0]
                        print("found ",suspect[1])
                        source_image="C:\\Users\\LEGION\\PycharmProjects\\Outlaws_Detection\\snapshot.jpg"
                        destination_folder="C:\\xampp\\htdocs\\Laravel\\Outlaws_Detection\\storage\\app\\public\\uploads\\found_suspect"
                        random_name=''.join(
                            random.choices('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',k=10))

                        # Get the file extension of the source image
                        file_extension=os.path.splitext(source_image)[1]

                        # Construct the destination path with the random name and original extension
                        destination_image=os.path.join(destination_folder,random_name + file_extension)

                        # Copy the image to the destination folder with the random name
                        shutil.copy(source_image,destination_image)

                        print(f"Image copied and renamed to {destination_image}")
                        suspect_image_name=os.path.basename(destination_image)
                        # insert in suspect notification table and alert stuffs
                        f=open("C:\\xampp\\htdocs\\Laravel\\Outlaws_Detection\\storage\\app\\file.txt","r")
                        token=f.read()
                        sql="SELECT * FROM devices WHERE token = %s"
                        cursor.execute(sql,[token])
                        devices=cursor.fetchone()
                        device_id=devices[0]

                        sql_insert="INSERT INTO notification (device_id, suspect_id, suspect_image_name) VALUES (%s, %s, %s)"
                        record=(device_id,suspect_id,suspect_image_name)
                        cursor.execute(sql_insert,record)
                        conn.commit()
                        print("Record inserted successfully into notification table")
                        # buzzer or silent
                        suspect_alert_mode=suspect[6]
                        print(suspect_alert_mode)

                        if (suspect_alert_mode == "buzzer"):
                            print("ghanti bhaji")
                            threading.Thread(target=self.play_sound(suspect)).start()
                            break
                        else:
                            alert=tk.Tk()
                            alert.title("Alert")

                            suspect_name=str(suspect[1])
                            msg="This is an alert! Suspect " + suspect_name + " has been found"
                            label=tk.Label(alert,text=msg)
                            label.pack()
                            button=tk.Button(alert,text="Close",command=lambda: alert.destroy())
                            button.pack()
                            alert.mainloop()



                    else:
                        # continue
                        print("not found")
            if(isNotSuspect):
                alert=tk.Tk()
                alert.title("")
                msg="All Clear!"
                label=tk.Label(alert,text=msg)
                label.pack()
                button=tk.Button(alert,text="Close",command=lambda: alert.destroy())
                button.pack()
                alert.mainloop()

def validateLogin(username, password):
    print("username entered :", username.get())
    print("password entered :", password.get())
    username = username.get()
    password = password.get()
    sql = "SELECT * FROM user WHERE username = %s and password = %s and role ='security_staff' and status ='1'"
    cursor.execute(sql,[(username),(password)])
    # cursor.execute(sql, ['airport1@gmail.com', '1234'])
    record = cursor.fetchone()
    if record:
        print("Success")
        f = open("C:\\xampp\\htdocs\\Laravel\\Outlaws_Detection\\storage\\app\\file.txt", "r")


        token = f.read()
        print(token)
        sql = "SELECT * FROM devices WHERE token = %s and status ='1'"
        cursor.execute(sql,[(token)])
        record = cursor.fetchone()
        if record:

            print("perfect")
            msgLabel = Label(tkWindow, text="Successfully Logged in", fg="green", font=('arial', 12)).grid(row=8, column=1)
            tkWindow.destroy()
            root = tk.Tk()
            app = CameraApp(root, "Camera App")
            #Open new window -> open camera and detect
        else:
            print("issue")
            emptyLabel=Label(tkWindow,text="Invalid User",fg="red",font=('arial',12))
            emptyLabel.grid(row=4,columnspan=2)
            # msgLabel = Label(tkWindow, text="Invalid User", font=('arial', 12, 'bold')).grid(row=8, column=2)

    else:
        emptyLabel=Label(tkWindow,text="Invalid User",fg="red",font=('arial',12))
        emptyLabel.grid(row=4,columnspan=2)
        # msgLabel = Label(tkWindow, text="Invalid User",fg="red", font=('arial', 12)).grid(row=8, column=1)
        print("fail")
    return

conn = mysql.connector.connect(
   user='root', password='', host='localhost', database='outlaws_detection')
cursor = conn.cursor()
sql = "SELECT * FROM suspect WHERE status ='1'"
cursor.execute(sql)
records = cursor.fetchall()
image_names = []

# Loop through the fetched records and extract image_name column
for record in records:
    #check all_states == 1
    if(record[15] == "1"):
        image_names.append(record[8])
    else:
        f = open("C:\\xampp\\htdocs\\Laravel\\Outlaws_Detection\\storage\\app\\file.txt", "r")

        token = f.read()
        sql = "SELECT a.state_id FROM devices AS d INNER JOIN airport AS a ON d.airport_id = a.id WHERE d.token = %s"
        cursor.execute(sql, [token])
        devices = cursor.fetchone()
        state_id = devices[0]
        sql = "SELECT suspect_id FROM wanted_states WHERE state_id = %s"
        cursor.execute(sql,[state_id])
        wanted_states = cursor.fetchall()
        suspect_ids = [wanted_state[0] for wanted_state in wanted_states]
        if(suspect_ids):
            sql = "SELECT image_name FROM suspect WHERE status ='1' AND id IN (%s)"
            if suspect_ids:
                placeholders = ', '.join(['%s' for _ in suspect_ids])
            else:
                placeholders = '%s'
            sql = sql % placeholders
            cursor.execute(sql, suspect_ids)
            results = cursor.fetchall()
            for result in results:
                image_names.append(result[0])
        # image_names.append()
print(image_names)

# Window
tkWindow = Tk()
tkWindow.title('Airport Security Staff Login')

# Load the image
img = Image.open("airport_security.jpg")
img = img.resize((150, 150))

# Convert the image to PhotoImage
photo = ImageTk.PhotoImage(img)

# Display the image
imageLabel = Label(tkWindow, image=photo)
imageLabel.grid(row=0, columnspan=2, padx=10, pady=10)

# Heading label
titleLabel = Label(tkWindow, text="Airport Security Staff Login", font=('arial', 14, 'bold'))
titleLabel.grid(row=1, columnspan=2, pady=5)

# Username label and text entry box
usernameLabel = Label(tkWindow, text="User Name:", font=('arial', 12))
usernameLabel.grid(row=2, column=0, padx=10, pady=5)
username = StringVar()
usernameEntry = Entry(tkWindow, textvariable=username, width=30)
usernameEntry.grid(row=2, column=1, padx=10, pady=5)

# Password label and password entry box
passwordLabel = Label(tkWindow, text="Password:", font=('arial', 12))
passwordLabel.grid(row=3, column=0, padx=10, pady=5)
password = StringVar()
passwordEntry = Entry(tkWindow, textvariable=password, show='*', width=30)
passwordEntry.grid(row=3, column=1, padx=10, pady=5)

# Empty label for spacing
emptyLabel = Label(tkWindow, text="", font=('arial', 12))
emptyLabel.grid(row=4, columnspan=2)

validateLogin = partial(validateLogin, username, password)

# Login button
loginButton = Button(tkWindow, text="Login", command=validateLogin, font=('arial', 12))
loginButton.grid(row=5, columnspan=2, pady=10)

# Calculate window size based on content
window_width = max(imageLabel.winfo_reqwidth(), titleLabel.winfo_reqwidth())
window_height = imageLabel.winfo_reqheight() + titleLabel.winfo_reqheight() + 100  # Extra padding

# Set window size
tkWindow.geometry("350x350")

tkWindow.mainloop()
