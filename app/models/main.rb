class Main < ApplicationRecord
  has_many :food_intermediates
  has_many :subs, through: :food_intermediates
  enum genre: { 麺: 0, ご飯: 1, パン: 2, お菓子: 3 }
end
