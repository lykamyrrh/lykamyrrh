from tkinter import *
from tkinter import messagebox

def validate_login():
    entered_username = username_entry.get()
    entered_password = password_entry.get()

    valid_username = "username"
    valid_password = "password"

    if entered_username == valid_username and entered_password == valid_password:
        message = "Login Successful"
    else:
        message = "Login Failed. Invalid username or password."

    messagebox.showinfo("Login Result", message)

window = Tk()
window.title('Login')
window.geometry("500x400")
window.configure(bg='pink')

custom_font = ("Arial", 13)
center_frame = Frame(window, bg='pink')
center_frame.pack(expand=True)

Label(center_frame, text="Username:", bg='pink', font=custom_font).grid(row=1, column=1, sticky="e")
username_entry = Entry(center_frame, bg='#cdedce')
username_entry.grid(row=1, column=2)
Label(center_frame, text="Password:", bg='pink', font=custom_font).grid(row=2, column=1, sticky="e", pady=5)
password_entry = Entry(center_frame, show='*', bg='#cdedce')
password_entry.grid(row=2, column=2)
Button(center_frame, text="Login", font=custom_font, bg='#cdedce', command=validate_login).grid(row=3, column=1,
                                                                                                columnspan=2, pady=15)

window.mainloop()

import tkinter as tk


def calculate_loan_schedule(principal, annual_interest_rate, duration):
    m_interest_rate = annual_interest_rate * 100 / 12 / 100
    m_payment = (principal * m_interest_rate * (1 +
                                                m_interest_rate) ** (duration // 30)) // ((1 +
                                                                                           m_interest_rate) ** (
                                                                                                      duration // 30) - 1)
    t_payment = m_payment * (duration // 30)
    t_interest = t_payment - principal
    return m_payment, t_payment, t_interest


def compute_loan():
    principal = int(principal_entry.get())
    annual_interest_rate = int(interest_rate_entry.get())
    duration = int(duration_entry.get())

    m_payment, t_payment, t_interest = calculate_loan_schedule(principal, annual_interest_rate, duration)

    total_amount_label.config(text=f"Total Amount to Pay: ₱{t_payment}")
    total_interest_label.config(text=f"Total Interest to Pay: ₱{t_interest}")
    monthly_payment_label.config(text=f"Amount per Schedule: ₱{m_payment}")


def reset_loan():
    principal_entry.delete(0, tk.END)
    interest_rate_entry.delete(0, tk.END)
    duration_entry.delete(0, tk.END)
    total_amount_label.config(text="")
    total_interest_label.config(text="")
    monthly_payment_label.config(text="")


root = tk.Tk()
root.title("Loan Estimator")
root.geometry("720x480")
custom_font = ('Arial', 13)
root.configure(bg='pink')

screen_width = root.winfo_screenwidth()
screen_height = root.winfo_screenheight()
x = (screen_width - 720) // 2
y = (screen_height - 480) // 2
root.geometry("720x480+{}+{}".format(x, y))

principal_label = tk.Label(root, text="Enter the loan amount: ₱", font=custom_font, bg='pink', pady=10)
principal_label.pack()
principal_entry = tk.Entry(root, bg='#cdedce')
principal_entry.pack()

interest_rate_label = tk.Label(root, text="Enter the annual interest rate (%): ", font=custom_font, bg='pink', pady=10)
interest_rate_label.pack()
interest_rate_entry = tk.Entry(root, bg='#cdedce')
interest_rate_entry.pack()

duration_label = tk.Label(root, text="Enter the loan duration (days): ", font=custom_font, bg='pink', pady=10)
duration_label.pack()
duration_entry = tk.Entry(root, bg='#cdedce')
duration_entry.pack()

compute_button = tk.Button(root, text="Compute", command=compute_loan, font=custom_font, bg='#cdedce')
compute_button.pack(pady=10)

total_amount_label = tk.Label(root, text="", font=custom_font, bg='pink')
total_amount_label.pack(pady=10)

total_interest_label = tk.Label(root, text="", font=custom_font, bg='pink')
total_interest_label.pack(pady=10)

monthly_payment_label = tk.Label(root, text="", font=custom_font, bg='pink')
monthly_payment_label.pack(pady=10)

reset_button = tk.Button(root, text="Reset", command=reset_loan, font=custom_font, bg='#cdedce')
reset_button.pack(pady=10)

root.mainloop()

import tkinter as tk


def add_lender():
    loan_ID = loan_ID_entry.get()
    lender_name = lender_name_entry.get()
    loan_amount = loan_amount_entry.get()
    loan_status = "Working"

    loans_list.insert(tk.END,
                      f"\nCustomer Information:   \nLoan Id :{loan_ID} | Lender name:{lender_name} | Loan amount: ${loan_amount} | Status: {loan_status} ")


root = tk.Tk()
root.title("Loan Management System")
root.configure(bg='pink')
custom_font = ('Arial', 13)

loan_ID_label = tk.Label(root, text="Loan ID: ", bg='pink', pady=10, font=custom_font)
lender_name_label = tk.Label(root, text="Customer Name:", bg='pink', pady=10, font=custom_font)
loan_amount_label = tk.Label(root, text="Loan Amount:", bg='pink', pady=10, font=custom_font)

loan_ID_entry = tk.Entry(root, font=custom_font)
lender_name_entry = tk.Entry(root, font=custom_font)
loan_amount_entry = tk.Entry(root, font=custom_font)

loan_ID_entry.configure(bg='#cdedce')
lender_name_entry.configure(bg='#cdedce')
loan_amount_entry.configure(bg='#cdedce')

add_lender_button = tk.Button(root, text="Add Loan", command=add_lender, font=custom_font)

loans_list = tk.Listbox(root, height=30, width=150, font=custom_font)

loan_ID_label.pack()
loan_ID_entry.pack()
lender_name_label.pack()
lender_name_entry.pack()
loan_amount_label.pack()
loan_amount_entry.pack()
add_lender_button.pack(pady=10)
loans_list.pack()
add_lender_button.configure(bg='#cdedce')
loans_list.configure(bg='#cdedce')

root.mainloop()
