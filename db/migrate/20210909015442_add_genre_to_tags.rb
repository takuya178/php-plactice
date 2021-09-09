class AddGenreToTags < ActiveRecord::Migration[6.0]
  def change
    add_column :tags, :genre, :string
  end
end
