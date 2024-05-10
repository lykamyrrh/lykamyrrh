import random
import time
import tkinter as tk

words = ["python", "java", "malware", "bluetooth", "agile", "encryption", "cpu", "application", "byte", "compile"]

class WordGuessGame:
    def __init__(self, root):
        self.root = root
        self.root.title("Word Guessing Game")
        self.timer = 20
        self.guessed_word_index = 0
        self.start_time = None
        self.word_to_guess = tk.StringVar(value="")

        self.setup_gui()

    def setup_gui(self):
        tk.Label(self.root, text="Welcome to Pinoy Henyo!", font=("Arial", 16)).pack(pady=20)

        self.timer_label = tk.Label(self.root, text=f"Time remaining: {self.timer} seconds", font=("Arial", 12))
        self.timer_label.pack()

        self.word_label = tk.Label(self.root, textvariable=self.word_to_guess, font=("Arial", 14))
        self.word_label.pack()

        self.guess_entry = tk.Entry(self.root, font=("Arial", 14))
        self.guess_entry.pack(pady=10)

        self.submit_button = tk.Button(self.root, text="Submit Guess", command=self.check_guess, font=("Arial", 14))
        self.submit_button.pack()

    def start_game(self):
        self.start_time = time.time()
        self.next_word()

    def next_word(self):
        if self.guessed_word_index < len(words):
            self.word_to_guess.set(words[self.guessed_word_index])
            self.timer = 20
            self.timer_label.config(text=f"Time remaining: {self.timer} seconds")
            self.guess_entry.delete(0, 'end')
            self.guess_entry.focus()
        else:
            self.word_to_guess.set("You've guessed all the words! Game over.")

    def check_guess(self):
        guess = self.guess_entry.get().lower()
        word = self.word_to_guess.get()
        elapsed_time = int(time.time() - self.start_time)

        if guess == word:
            self.guessed_word_index += 1
            if self.guessed_word_index < len(words):
                self.next_word()
            else:
                self.word_to_guess.set("You've guessed all the words! Game over.")
        elif self.timer - elapsed_time <= 0:
            self.guessed_word_index += 1
            if self.guessed_word_index < len(words):
                self.next_word()
            else:
                self.word_to_guess.set("Time is up! The word was: " + word)
        else:
            self.timer_label.config(text=f"Time remaining: {self.timer - elapsed_time} seconds")

def main():
    root = tk.Tk()
    game = WordGuessGame(root)
    start_button = tk.Button(root, text="Start Game", command=game.start_game, font=("Arial", 14))
    start_button.pack()
    root.mainloop()

if __name__ == "__main__":
    main()
