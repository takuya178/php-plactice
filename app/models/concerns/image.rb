module Image
  extend ActiveSupport::Concern

  included do
    validate :image_content, :image_size
  end

  class_methods do
    
    def image_content
      image_extension = ['image/png']
      errors.add(:image, "の拡張子が間違っています") unless image.content_type.in?(image_extension)
    end
  
    def image_size
      if image.blob.byte_size > 5.megabytes
        image.purge
        errors.add(:image, "は5MB以内にしてください")
      end
    end
  end
end