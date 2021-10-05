class FoodCombination < ApplicationRecord
  belongs_to :main
  belongs_to :sub

  enum stores: { seven: 0, lawson: 1 }

  def sugar_combination
    { 'sugar': main.sugar + sub.sugar }
  end

  def lipid_combination
    { 'sugar': main.lipid + sub.lipid }
  end

  def salt_combination
    { "組み合わせの塩分": main.salt + sub.salt }
  end
end
