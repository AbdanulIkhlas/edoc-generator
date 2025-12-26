import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import SectionHeading from "@/components/atoms/SectionHeading";
import GuestbookEntry from "@/components/molecules/GuestbookEntry";
import { guestbookContent, initialGuestbookEntries, GuestbookEntry as GuestbookEntryType } from "@/data/guestbook";
import { useToast } from "@/hooks/use-toast";

const GuestbookSection = () => {
  const [entries, setEntries] = useState<GuestbookEntryType[]>(initialGuestbookEntries);
  const [name, setName] = useState("");
  const [message, setMessage] = useState("");
  const [selectedEmoji, setSelectedEmoji] = useState<string | undefined>();
  const { toast } = useToast();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!name.trim() || !message.trim()) {
      toast({
        title: "Please fill in all fields",
        variant: "destructive",
      });
      return;
    }

    const newEntry: GuestbookEntryType = {
      id: Date.now().toString(),
      name: name.trim(),
      message: message.trim(),
      emoji: selectedEmoji,
      timestamp: new Date().toISOString(),
    };

    setEntries([newEntry, ...entries]);
    setName("");
    setMessage("");
    setSelectedEmoji(undefined);
    
    toast({
      title: "Message added!",
      description: "Thanks for signing the guestbook.",
    });
  };

  return (
    <section className="py-24 bg-background">
      <div className="container mx-auto px-6">
        <SectionHeading
          title={guestbookContent.heading}
          subtitle={guestbookContent.subheading}
        />

        {/* Form */}
        <motion.form
          onSubmit={handleSubmit}
          className="mb-12 p-6 rounded-2xl bg-card border border-border"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <div className="space-y-4">
            <div>
              <input
                type="text"
                value={name}
                onChange={(e) => setName(e.target.value)}
                placeholder={guestbookContent.namePlaceholder}
                className="w-full px-4 py-3 rounded-xl bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50"
              />
            </div>
            <div>
              <textarea
                value={message}
                onChange={(e) => setMessage(e.target.value)}
                placeholder={guestbookContent.placeholder}
                rows={3}
                className="w-full px-4 py-3 rounded-xl bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 resize-none"
              />
            </div>
            
            {/* Emoji Selector */}
            <div className="flex items-center gap-4">
              <span className="text-sm text-muted-foreground">Add an emoji:</span>
              <div className="flex gap-2">
                {guestbookContent.emojiOptions.map((emoji) => (
                  <motion.button
                    key={emoji}
                    type="button"
                    onClick={() => setSelectedEmoji(emoji === selectedEmoji ? undefined : emoji)}
                    className={`w-10 h-10 rounded-lg flex items-center justify-center text-xl transition-colors ${
                      selectedEmoji === emoji 
                        ? "bg-primary/20 ring-2 ring-primary" 
                        : "bg-secondary hover:bg-secondary/80"
                    }`}
                    whileHover={{ scale: 1.1 }}
                    whileTap={{ scale: 0.95 }}
                  >
                    {emoji}
                  </motion.button>
                ))}
              </div>
            </div>

            <motion.button
              type="submit"
              className="px-6 py-3 bg-primary text-primary-foreground font-medium rounded-xl hover:shadow-lg transition-shadow"
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              {guestbookContent.submitLabel}
            </motion.button>
          </div>
        </motion.form>

        {/* Entries */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <AnimatePresence>
            {entries.map((entry, index) => (
              <GuestbookEntry key={entry.id} entry={entry} index={index} />
            ))}
          </AnimatePresence>
        </div>
      </div>
    </section>
  );
};

export default GuestbookSection;
