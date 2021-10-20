class FoodCombination < ApplicationRecord

  belongs_to :main
  belongs_to :sub
  has_one_attached :image

  enum stores: { seven: 0, lawson: 1 }

  def get_sugar
    { '組み合わせ成分値': sprintf("%.1f", main.sugar + sub.sugar) }
  end

  def get_lipid
    { '組み合わせ成分値': sprintf("%.1f", main.lipid + sub.lipid) }
  end

  def get_salt
    { "組み合わせ成分値": sprintf("%.1f", main.salt + sub.salt) }
  end  

class << self
  def component_sum
    @food.each do |food|
      scope :sugar_sum, -> { food.main.sugar + food.sub.sugar }
    end
  end
end

end
