class Sub < ApplicationRecord
  has_many :food_combinations, dependent: :destroy
  has_many :mains, through: :food_combinations
  has_one_attached :image

  include FoodValidate

  validate :image_content_type, :image_size, if: :was_attached?

  def image_content_type
    image_type = ['image/png', 'image/jpg', 'image/jpeg']
    errors.add(:image, "の拡張子は.png .jpg .jpegのみです") unless image.content_type.in?(image_type)
  end

  def was_attached?
    self.image.attached?
  end

  def image_size
    if image.blob.byte_size > 5.megabytes
      image.purge
      errors.add(:image, "は5MB以内にしてください")
    end
  end 


end
